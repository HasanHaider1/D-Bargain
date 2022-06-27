<?php

declare(strict_types=1);

use  productbargain\Install\Installer;
use PrestaShop\PrestaShop\Core\Domain\Product\Exception\ProductException;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require_once __DIR__.'/vendor/autoload.php';
}

class ProductBargain extends Module
{
    public function __construct()
    {
        $this->name = 'productbargain';
     //$this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Basmah Khan';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => '1.7.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('A Product Bargain');
        $this->description = $this->l('Let customers bargain');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
        $this->controllers = ['chat'];


        $tab_id = Tab::getIdFromClassName('Adminbargain');
        $languages = Language::getLanguages(false);

        if ($tab_id == false)
        {
            $tab = new Tab();
            $tab->class_name = 'Adminbargain';
            $tab->route_name = 'bargain';
            $tab->position = 99;
            $tab->id_parent = (int)Tab::getIdFromClassName('SELL'); // This value isn't listed in the developer documenation but I found it in the database. Alternatively it may be wise to use another value as DEFAULT may not exist in earlier 1.7 versions (I have not checked this!)
            $tab->module = 'productbargain';
            foreach ($languages as $language) {
                $tab->name[$language['id_lang']] = "Product Bargains";
            }
            $tab->add();
        }
    }



    public function install(): bool
    {
        $installer = $this->getInstaller();
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        return parent::install() && $installer->install($this)&&
            $this->registerHook('additionalProductFormFields') &&
            $this->registerHook('actionProductFormBuilderModifier') &&
            $this->registerHook('actionAfterCreateProductFormHandler') &&
            $this->registerHook('actionAfterUpdateProductFormHandler') &&
            $this->registerHook('displayAdminProductsExtra')&&
            $this->registerHook('displayFooterProduct')&&
            $this->registerHook('actionFrontControllerSetMedia')&&
            $this->alterProductTable();
    }


    /**
     * Module uninstallation phase
     *
     * @return bool
     */
    public function uninstall(): bool
    {
        $installer = $this->getInstaller();

        return $installer->uninstall() && parent::uninstall() && $this->uninstallAlterProductTable();
    }

    /**
     * Return installer instance
     *
     * @return Installer
     */
    private function getInstaller(): Installer
    {
        return new Installer();
    }






    //CUSTOM FIELDS

    /**
     * Alter product table, add module fields
     *
     * @return bool true if success or already done.
     */
        protected function alterProductTable()
    {
        $sql = 'ALTER TABLE `' . pSQL(_DB_PREFIX_) . 'product` ADD `minimumprice` INT(50) NULL, ADD `startdate` DATE NULL, ADD `enddate` DATE NUll';
        // CLEAN_INSTALATION 1/2  (if you want to delete all data after an installation)
        // comment:
        Db::getInstance()->execute($sql);
        return true;
        // and uncomment:
        // return Db::getInstance()->execute($sql);
    }

    /**
     * Uninstalls sample tables required for demonstration.
     *
     * @return bool
     */
    private function uninstallAlterProductTable()
    {
       $sql = 'ALTER TABLE `' . pSQL(_DB_PREFIX_) . 'product` DROP `minimumprice`,`startdate`,`enddate`)';
       return Db::getInstance()->execute($sql);

    }


    /**
     * Hook allows to modify Products form and add additional form fields as well as modify or add new data to the forms.
     * FRONT_END
     * @param array $params
     */
    public function hookAdditionalProductFormFields($params)
    {
        return [
            (new FormField)
                ->setName('minimumprice')
                ->setType('number')
                ->setRequired(false)
                ->setLabel('Minimum Price'),
            (new FormField)
                ->setName('startdate')
                ->setType('date')
                ->setRequired(false)
                ->setLabel('Start Date'),
            (new FormField)
                ->setName('enddate')
                ->setType('date')
                ->setRequired(false)
                ->setLabel('End Date')
        ];
    }


    /**
     * Hook allows to modify Products form and add additional form fields as well as modify or add new data to the forms.
     * BACK_END
     * @param array $params
     */
    public function hookActionProductFormBuilderModifier(array $params)
    {
        /** @var $formBuilder \Symfony\Component\Form */
        $formBuilder = $params['form_builder'];
       // $formBuilder->remove('first_name');
      //  $formBuilder->get('last_name')->setRequired(false);
        $allFields = $formBuilder->all();
        foreach ($allFields as $inputField => $input) {
            $formBuilder->remove($inputField);
        }
        foreach ($allFields as $inputField => $input) {
            $formBuilder->add($input);
            if ($inputField == 'wholesale_price') {
                /** @var MoneyType::class \Symfony\Component\Form\Extension\Core\Type\MoneyType */
                $formBuilder->add(
                    'minimumprice',
                    MoneyType::class,
                    ['label' => 'Minimum Price']
                )->add(
                    'startdate',
                    DateType::class,
                    ['label' => 'Start Date']
                )->add(
                    'enddate',
                    DateType::class,
                    ['label' => 'Start Date']
                );
            }
        }

    }


    /**
     * Hook allows to modify Customers form and add additional form fields as well as modify or add new data to the forms.
     *
     * @param array $params
     *
     * @throws ProductException
     */
    public function hookActionAfterUpdateProductFormHandler(array $params)
    {
        $this->updateProductPrice($params);
    }

    /**
     * Hook allows to modify Products form and add additional form fields as well as modify or add new data to the forms.
     *
     * @param array $params
     *
     * @throws ProductException
     */
    public function hookActionAfterCreateProductFormHandler(array $params)
    {
        $this->updateProductPrice($params);
    }

    /**
     * Update / Create
     *
     * @param array $params
     *
     * @throws \PrestaShop\PrestaShop\Core\Module\Exception\ModuleErrorException
     */
    private function updateProductPrice(array $params)
    {
        $customerId = (int)$params['id'];
        /** @var array $customerFormData */
        $customerFormData = $params['form_data'];
        $minimumprice= $customerFormData['minimumprice'];
        $startdate= $customerFormData['startdate'];
        $enddate= $customerFormData['enddate'];
        try {
            $customer = new Product($customerId);
            $customer->minimumprice= $minimumprice;
            $customer->enddate=$enddate;
            $customer->startdate=$startdate;
            $customer->update();
        } catch (ReviewerException $exception) {
            throw new \PrestaShop\PrestaShop\Core\Module\Exception\ModuleErrorException($exception);
        }
    }

  public function hookDisplayAdminProductsExtra($params) {
      if (isset($params['id_product']) && (int)$params['id_product']) {
          $productId = (int)$params['id_product'];
          $product = new Product($productId);
          $this->context->smarty->assign('product', $product);
      }
        return $this->display(__FILE__, 'templates/admin/extra.tpl');
    }
    public function hookDisplayFooterProduct($params) {
       /* if (isset($params['id_product']) && (int)$params['id_product']) {
            $productId = (int)$params['id_product'];
            $product = new Product($productId);
            $this->context->smarty->assign('product', $product);
        }*/
        if ('product' === $this->context->controller->php_self) {
            return $this->display(__FILE__, '/views/templates/front/bargain.tpl');
        }
    }

    public function hookActionFrontControllerSetMedia($params){
        // Only on product page

            $this->context->controller->registerStylesheet(
                'module-productbargain-style',
                'modules/'.$this->name.'/views/css/chatmodal.css',
                [
                    'media' => 'all',
                    'priority' => 200,
                ]
            );

            $this->context->controller->registerJavascript(
                'module-productbargain-chat-modal',
                'modules/'.$this->name.'/views/js/chatmodal.js',
                [
                    'priority' => 200,
                    'attribute' => 'async',
                ]
            );
        }



}