<section class="msger">
    <header class="msger-header">
        <div class="msger-header-title">
            <i class="fas fa-comment-alt"></i> Bargain Chat
        </div>
        <div class="msger-header-options">
            <span><i class="fas fa-cog"></i></span>
        </div>
    </header>

    <main class="msger-chat">
        <div class="msg left-msg">
            <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
            ></div>

            <div class="msg-bubble">
                <div class="msg-info">
                    <div class="msg-info-name">Admin</div>
                    <div class="msg-info-time">{$smarty.now|date_format:$config.date}</div>
                </div>

                <div class="msg-text">
                    Hi, do you wanna bargain? Go ahead and send me a message.
                </div>
            </div>
        </div>
    </main>

    <form action="{$link->getModuleLink('productbargain','chat',['ajax'=>true])}" method="POST" id='bargainform' class="msger-inputarea">
        <input type="text" name="producturl" id="producturl" hidden value="{$product.url}" class="msger-input">
        <input type="text" name="productid" id="productid" hidden value="{$product.id}" class="msger-input">
        <input type="text" name="productprice" id="productprice" hidden value="{$product.price_amount}" class="msger-input">
        <input type="number" name="price" id="price" class="msger-input" placeholder="Enter price">
        <button id="bargainbutton"  name="button" type="button" onclick="submitform()" class="msger-send-btn">Send</button>
    </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
    function submitform(){
        var today = moment().format('MMM D, YYYY');
        htm='<div class="msg right-msg"> <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"></div> <div class="msg-bubble"> <div class="msg-info"> <div class="msg-info-name">User</div> <div class="msg-info-time">'+today;
        htm+='</div> </div> <div class="msg-text"> '+$('#price').val();
        htm+='</div> </div> </div>';
        $('.msger-chat').append(htm);
     //   document.getElementById("bargainbutton").disabled = true;
            var formData = {
                producturl: $("#producturl").val(),
                productid: $("#productid").val(),
                productprice: $("#productprice").val(),
                price:$("#price").val()
            };
        $.ajax({
            type     : "POST",
            cache    : false,
            dataType: "text",
            url:  $("#bargainform").attr('action'),
            data     : formData,
            success  : function(data) {
                appendmsg(data,today);
               // setTimeout(appendmsg, 5000,data,today);

            }
        });

    }
    function appendmsg(data,today){
        htm='<div class="msg left-msg"> <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"></div> <div class="msg-bubble"> <div class="msg-info"> <div class="msg-info-name">Admin</div> <div class="msg-info-time">'+today;
        htm+='</div> </div> <div class="msg-text"> '+data.toString();
        htm+='</div> </div> </div>';
        $('.msger-chat').append(htm);
    }
</script>