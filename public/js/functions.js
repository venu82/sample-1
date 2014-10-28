/**
 * ajax function which is used by contact and login
 */
function ajax(id,action){
    $('#message').html('Looading...');
    $('.ErrorLabel').remove();
    var fields=$(id).serializeArray();
    $.ajax({
        type: 'POST',
        url: action,
        data: fields,
        dataType: 'json',
        success: function(data){
            $('#message').html(data.message);
            if(data.url && data.url.length>0){
                window.location=data.url;
                $('#message').html(data.message+", Redirecting..");
            }
            $.each(data,function(k,v){
                if(k!="message" && k!='url')
                    $('#'+k).after('<div class="ErrorLabel">'+v+'</div>');
            });
          
        },
        error: function(){
            alert('invalid request');
        }

    });
    return false;
}

/**
 * jquery function called when dom is ready
 */
$(document).ready(function(){
    $('#login').submit(function(){
        ajax('#login',this.getAttribute('action'));
        return false;
    });
    $('#contact').submit(function(){
        ajax('#contact',this.getAttribute('action'));
        return false;
    });
});

