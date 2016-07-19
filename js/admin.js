jQuery(document).ready(function(){
    getUsers('table');
    getUsers('option');
    getToDos('table');
    getBuyList('table');

    jQuery('body').on('click', '#showTodoModal', function(){
        jQuery('#addTodo').modal('show');
    });

    jQuery('body').on('click', '#showBuyModal', function(){
        jQuery('#addBuy').modal('show');
    });

    jQuery('#saveTodoBtn').on('click', function(event) {
        todoname = jQuery('#todoname').val();
        user_todo = jQuery('#user_todo').val();
        if (todoname.length < 3) {
            jQuery('#todoname').parent().addClass('has-error');
        } else {
            jQuery.ajax({
                type: "POST",
                url: '/admin/ajax/addTodo.ajax.php',
                dataType: 'json',
                data: {
                    todoname: todoname,
                    user_todo: user_todo
                },
                success: function(n) {
                    if (n.code == 200){
                        jQuery('#addTodo').modal('hide');
                        getToDos('table');
                    }else{
                        alert('Error - Code: ' + n.code);
                    }
                }
            });
        }
    });

    jQuery('#saveBuyBtn').on('click', function(event) {
        item = jQuery('#item').val();
        quantity = jQuery('#quantity').val();
        user_buy = jQuery('#user_buy').val();
        if (item.length < 3 || quantity <= 0) {
            jQuery('#item').parent().addClass('has-error');
            jQuery('#quantity').parent().addClass('has-error');
        } else {
            jQuery.ajax({
                type: "POST",
                url: '/admin/ajax/addBuy.ajax.php',
                dataType: 'json',
                data: {
                    item: item,
                    quantity: quantity,
                    user_buy: user_buy
                },
                success: function(n) {
                    if (n.code == 200){
                        jQuery('#addBuy').modal('hide');
                        getBuyList('table');
                    }else{
                        alert('Error - Code: ' + n.code);
                    }
                }
            });
        }
    });

    jQuery('body').on('click', '.mark_done', function(){
        itemid = jQuery(this).data('id');
        jQuery.ajax({
            type: "POST",
            url: '/admin/ajax/markDone.ajax.php',
            dataType: 'json',
            data: {
                itemid: itemid
            },
            success: function(n) {
                if (n.code == 200){
                    jQuery('#addTodo').modal('hide');
                    getToDos('table');
                }else{
                    alert('Error - Code: ' + n.code);
                }
            }
        });
    });

    jQuery('body').on('click', '.remove_item', function(){
        itemid = jQuery(this).data('id');
        jQuery.ajax({
            type: "POST",
            url: '/admin/ajax/removeBuyItem.ajax.php',
            dataType: 'json',
            data: {
                itemid: itemid
            },
            success: function(n) {
                if (n.code == 200){
                    jQuery('#addBuy').modal('hide');
                    getBuyList('table');
                }else{
                    alert('Error - Code: ' + n.code);
                }
            }
        });
    });

});

function getUsers(type){
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        data: {
            type: type
        },
        url: '/admin/ajax/getUsers.ajax.php',
        success: function(e) {
            if (e.code == 0){
                if (type == 'table'){
                    jQuery('#users div').empty().html(e.data);
                }else{
                    jQuery('.userfill').html(e.data);
                }
            }else{
                alert('Error. Code: ' + e.code);
            }
        }
    })
}
