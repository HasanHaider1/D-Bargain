<?php
/**
 * <ModuleClassName> => ProductBargain
 * <FileName> => chat.php
 * Format expected: <ModuleClassName><FileName>ModuleFrontController
 */
class ProductBargainChatModuleFrontController extends ModuleFrontController
{

    public $price;
    public $url;
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:productbargain/views/templates/front/bargain.tpl');
    }


    function getClosest($search, $arr){
        $closest = null;
        foreach ($arr as $item) {
            if ($closest === null || abs($search - $closest) > abs($item['percentage'] - $search)) {
                $closest = $item['id_percentage'];
            }
        }
        return $closest;
    }

    public function postProcess(){
        $this->price=Tools::getValue('price');
        $productprice=Tools::getValue('productprice');
        $productid=Tools::getValue('productid');
        $session=Context::getContext()->cookie->checksum;
        $query = 'SELECT * FROM `'._DB_PREFIX_.'bargain_setting` WHERE `id_setting` = 1';
        $setting = Db::getInstance()->getRow($query);
        $max_iteration=$setting['max_iterations'];
        $percentages=(Db::getInstance())->executeS((new DbQuery())
            ->from('bargain_percentage','b')
        );
        $query = 'SELECT * FROM `'._DB_PREFIX_.'product` WHERE `id_product` = '.$productid;
        $product = Db::getInstance()->getRow($query);
        $query = 'SELECT * FROM `'._DB_PREFIX_.'bargains` WHERE `user_id` = "'.$session.'" AND `product_id`='.$productid;
        $bargain = Db::getInstance()->getRow($query);

        $today = date('Y-m-d');
        $contractDateBegin = date('Y-m-d', strtotime($product['startdate']));
        $contractDateEnd = date('Y-m-d', strtotime($product['enddate']));
        if(($today >= $contractDateBegin) && ($today <= $contractDateEnd)) {
            if ($bargain['status'] == 0 && $bargain['iterations'] < $max_iteration) {
                if ($product['minimumprice'] <= $this->price) {
                    $status = 1;
                    if ($bargain == false) {
                        $iterations = 1;
                        $bargainid = Db::getInstance()->execute("INSERT INTO `" . _DB_PREFIX_ . "bargains` (`final_price`,`user_id`,`status`,`product_price`,`product_id`,`iterations`) VALUES (".$this->price."," . $session . "," . $status . "," . $productprice . "," . $productid . "," . $iterations . ")");
                        $query = 'SELECT * FROM `'._DB_PREFIX_.'bargains` WHERE `user_id` = "'.$session.'" AND `product_id`='.$productid;
                        $bargain = Db::getInstance()->getRow($query);
                        $bargainid=$bargain['id_bargain'];  die($bargainid);
                    } else {
                        $iterations = $bargain['iterations'] + 1;
                        Db::getInstance()->execute("UPDATE `" . _DB_PREFIX_ . "bargains` SET  `iterations`=" . $iterations . ",`final_price`=" . $this->price . " ,`status`=".$status." where `id_bargain`=" . $bargain['id_bargain']);
                    }
                    $displaymessage = "Please add to cart";
                    Db::getInstance()->execute("INSERT INTO `" . _DB_PREFIX_ . "bargain_iterations` (`price`,`iteration_num`,`message`,`bargain_id`) VALUES (" . $this->price . "," . $iterations . ",'". $displaymessage . "'," .$bargain['id_bargain'] . ")");

                } else {
                    $status = 0;
                    if ($bargain == false) {
                        $iterations = 1;
                        $bargainid =Db::getInstance()->execute("INSERT INTO `"._DB_PREFIX_."bargains` (`user_id`,`status`,`product_price`,`product_id`,`iterations`) VALUES ('" . $session . "'," . $status . "," . $productprice . "," . $productid . "," . $iterations . ")");
                    } else {
                        $iterations = $bargain['iterations'] + 1;
                        $bargainid = $bargain['id_bargain'];
                        Db::getInstance()->execute("UPDATE `" . _DB_PREFIX_ . "bargains` SET `iterations`=" . $iterations . ", `status`=" . $status . " where `id_bargain`=" . $bargainid);
                    }
                    $pricecalculation = round((($product['minimumprice'] - $this->price) / $productprice) * 100);
                    $closestid = $this->getClosest($pricecalculation, $percentages);
                    $message = (Db::getInstance())->executeS((new DbQuery())->select('message')
                        ->from('bargain_message', 'b')->where('percentage_id = ' . $closestid)
                    );
                    $m2 = array();
                    foreach ($message as $m) {
                        array_push($m2, $m['message']);
                    }
                    $displaymessage = $m2[array_rand($m2)];
                    Db::getInstance()->execute("INSERT INTO `" . _DB_PREFIX_ . "bargain_iterations` (`price`,`iteration_num`,`message`,`bargain_id`) VALUES (" . $this->price . "," . $iterations . ",'". $displaymessage. "'," . $bargainid . ")");
                }


            } else if($bargain['status'] == 0 && $bargain['iterations'] >= $max_iteration) {
                $pricecalculation =($product['minimumprice'] + $productprice) / 2;
                Db::getInstance()->execute("UPDATE `" . _DB_PREFIX_ . "bargains` SET  `final_price`=" . $pricecalculation . " where `id_bargain`=" . $bargain['id_bargain']);
                $displaymessage = "Final price is ".$pricecalculation.". Please proceed with the order";
            }else{
                $displaymessage = "Bargaining session over.";
            }
        }else{
            $displaymessage ="Bargaining duration over";
        }

       die(Tools::jsonEncode($displaymessage));

    }

}