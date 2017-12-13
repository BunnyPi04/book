// jQuery.noConflict();

function checkRePass() {      //kiểm tra password confirm
    var pass1 = document.getElementById('password');
    var pass2 = document.getElementById('password-confirm');
    var message = document.getElementById('confirmMessage'); 
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    if(pass1.value == pass2.value){      
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Password Match!"
    }else{  
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Password Do Not Match!"    }
}             //thay thế textarea bằng editor
function validateCouponForm() {
    // console.log($('#type').value() == "Percent");
    if (($('#type').val() == "Percent") && (($('#amount').val() < 0 || ($('#amount')).val() > 100))) {
        alert("Giảm theo phần trăm phải > 0% và < 100%!");
        return false;
    }
    if (($('#type').val() == "Price") && (($('#amount').val() < 1000 || (($('#amount')).val() % 1000) != 0))) {
        alert("Giảm theo giá tiền cần là bội của 1,000đ!");
        return false;
    } else {
        return true;
    }
}
var shopping_cart=[];
var q = new Date();
var m = q.getMonth()+1;
var d = q.getDay();
var y = q.getYear();

var date = new Date(y,m,d);
function add_item(book_id) {
    $.ajax({
        type: 'get',
        url: 'http://localhost/bookstore/cart/add/' + book_id,
        data: book_id,
        success: function (data) {
            $('#cart-number').text(data.content);
            console.log(data);
            swal({
                position: 'top-right',
                type: 'success',
                title: 'Thêm thành công',
                showConfirmButton: false,
                timer: 1000,
                width: '300px',
            })
        }
    });
}
function destroyCart() {
    $.ajax({
        type: 'get',
        url: 'http://localhost/bookstore/cart/destroy/',
        data: 0,
        success: function (data) {
            $('#cart-number').text(data.content);
            console.log(data);
            swal({
                position: 'top-right',
                type: 'success',
                title: 'Xóa thành công',
                showConfirmButton: false,
                timer: 1000,
                width: '300px',
            })
        }
    });
}
function add_to_cart(sku, book_name, price, special_price, from_date) {
    var singleproduct={};
    // var customerId = $('#cus-id').val();
    // var storeId = $('#store-id').val();
    // txt_link += '&productId[]='+entity_id;
    if (shopping_cart.length > 0) {
        for(var i = 0; i <= shopping_cart.length; i++) {
            if (shopping_cart[i].SKU == sku) {
                shopping_cart[i].Number += 1;
            } else
            {
                singleproduct.SKU = sku;
                singleproduct.Book_name = book_name;
                singleproduct.Price = price;
                singleproduct.Special_price = special_price;
                singleproduct.From_date = from_date;
                if (singleproduct.Special_price != null && singleproduct.from_date <= date) {
                    singleproduct.Sub_total = singleproduct.Special_price;
                } else
                {
                    singleproduct.Sub_total = singleproduct.Price;
                };
                singleproduct.Number = 1;
                shopping_cart.push(singleproduct);
            }
        };
    } else
            {
                singleproduct.SKU = sku;
                singleproduct.Book_name = book_name;
                singleproduct.Price = price;
                singleproduct.Special_price = special_price;
                singleproduct.From_date = from_date;
                if (special_price != null && singleproduct.from_date <= date) {
                    singleproduct.Special_price = special_price;
                    singleproduct.Sub_total = singleproduct.Special_price;
                } else
                {
                    singleproduct.Special_price = null;
                    singleproduct.Sub_total = singleproduct.Price;
                }
                singleproduct.Number = 1;
                shopping_cart.push(singleproduct);
            };
    display_cart();
    console.log(shopping_cart);
};
function display_cart() {
    var order_body = document.getElementById('order_body');
    while(order_body.rows.length > 0) {
            order_body.deleteRow(0);
        }
    var grand_price = 0;
    var row_th = order_body.insertRow();
    var cell_th_nameSKU = row_th.insertCell(0);
    var cell_th_Number = row_th.insertCell(1);
    var cell_th_Price = row_th.insertCell(2);
    var cell_th_Special_price = row_th.insertCell(3);
    var cell_th_Sub_total = row_th.insertCell(4);
    cell_th_nameSKU.innerHTML = 'Tên sp';
    cell_th_Number.innerHTML = 'SL';
    cell_th_Price.innerHTML = 'Giá bìa';
    cell_th_Special_price = 'Sale';
    cell_th_Sub_total = 'Thành tiền';
    for (var product in shopping_cart) {
        var row = order_body.insertRow();
        //Create product Infomation
        var cellNameSKU = row.insertCell(0);
        var cellNumber = row.insertCell(1);
        var cellPrice = row.insertCell(2);
        var cellSpecial_price = row.insertCell(3);
        var cellSub_total = row.insertCell(4);

        // cellNameSKU.className = "col-md-3";
        // cellNumber.className = "col-md-1";
        // cellPrice.className = "col-md-1";
        // cellSpecial_price.className = "col-md-1";
        // cellSub_total.className = "col-md-1";
        // cellPrice.align = "right";
        // cellSpecial_price.align = "right";
        // cellSub_total.align = "right";
        //get value into inner HTML
//          cellSKU.innerHTML = shopping_cart[product].SKU;
        cellNameSKU.innerHTML = shopping_cart[product].Book_name + '<br/><small>' + shopping_cart[product].SKU + '</small>';
        cellNumber.innerHTML = shopping_cart[product].Number;
        if (shopping_cart[product].Special_price != null) {
            cellSpecial_price.innerHTML = shopping_cart[product].Special_price;
        } else
        {
            cellSpecial_price.innerHTML = '';
        }
        cellPrice.innerHTML = shopping_cart[product].Price;
        cellSub_total.innerHTML = shopping_cart[product].Sub_total;
        grand_price += shopping_cart[product].Sub_total;
    }
}