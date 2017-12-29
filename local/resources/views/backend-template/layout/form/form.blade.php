@extends('backend-template.master2')
@section('main')
<div class="block">
    <h1>New Review</h1>
    <form method="post">
        <div id="error_explanation">
            <h2>
                prohibited this idea from being saved:
            </h2>
            <ul>
                <li>
                    Error message
                </li>
            </ul>
        </div>
        <div class="field">
            <label>Địa điểm</label>
            <select>
                <option disabled value="">- Chọn địa điểm -</option>
                <option value="">King BBQ Hoàng Đạo Thúy</option>
                <option value="">CGV Royals City</option>
                <option value="">Lotte Keang Nam</option>
                <option value="">Địa điểm khác</option>
            </select>
        </div>
        <div class="field">
            <label>Short description: </label>
            <input type="text" name="title" id="submary">
        </div>
        <div class="field">
            <label>Content</label>
            <textarea name="content" id="idea_description"></textarea>
        </div>
        <div class="field">
            <label>Thời gian: </label>
            <input type="date" name="time">
        </div>
        <div class="field">
            <label>Đánh giá: </label>
            <section class='rating-widget'>
                <table>
                    <tr>
                        <td>Chất lượng dịch vụ</td>
                        <td>
                            <div class='rating-stars'>
                            <ul class='stars'>
                                <li class='star' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Chất lượng sản phẩm</td>
                        <td>
                            <div class='rating-stars'>
                            <ul class='stars'>
                                <li class='star' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>
                        </td>
                    </tr>
                </table>
            </section>
        </div>
        <div class="field">
            <label>Hình ảnh</label><button id="addScnt" class="btn btn-primary btn2">Thêm ảnh khác</button>
            <div id="filediv" style="width: 70%; float: right;">
                <input name="file[]" type="file" id="file"/></div>
                <input type="button" id="addScnt" class="upload" value="Add More Files"/>
                <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
        </div>
        <div class="row actions" style="padding: 0 15px;">
            <input type="submit" class="btn btn-primary btn2 col-md-3 col-md-offset-9" value="Hoàn thành">
        </div>
    </form>
</div>
<style type="text/css">
    .abc {
        width: 200px;
    }
</style>
<script type="text/javascript">
$(document).ready(function(){
    /* 1. Visualizing things on Hover - See next part for action on click */
    $('.stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
          if (e < onStar) {
            $(this).addClass('hover');
          }
          else {
            $(this).removeClass('hover');
            }
        });
    }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
        });
    });
  
    /* 2. Action to perform on click */
    $('.stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');
        
        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }
        
        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('.stars li.selected').last().data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            msg = "Thanks! You rated this " + ratingValue + " stars.";
        }
        else {
            msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
        responseMessage(msg);
    });
});
var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
    $('#addScnt').click(function() {
        $(this).before($("<div/>", {
            id: 'filediv'
        }).fadeIn('slow').append($("<input/>", {
            name: 'file[]',
            type: 'file',
            id: 'file'
        }), $("<br/><br/>")));
    });
    // Following function will executes on change event of file input to select different file.
    $('body').on('change', '#file', function() {
        if (this.files && this.files[0]) {
            abc += 1; // Incrementing global variable by 1.
            var z = abc - 1;
            var x = $(this).parent().find('#previewimg' + z).remove();
            $(this).before("<div id='abcd" + abc + "' class='abcd'><img class='abc' id='previewimg" + abc + "' src=''/></div>");
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
            $(this).hide();
            $("#abcd" + abc).append($("<img/>", {
                id: 'img',
                src: 'x.png',
                alt: 'delete'
            }).click(function() {
                $(this).parent().parent().remove();
            }));
        }
    });
    // To Preview Image
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };
    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name) {
            alert("First Image Must Be Selected");
        e.preventDefault();
    }
    });
});
// $(function() {
//     var scntDiv = $('#p_scents');
//     var i = $('#p_scents p').size() + 1;
    
//     $('#addScnt').live('click', function() {
//         $('<p><label for="p_scnts"><input type="file" id="p_scnt" size="20" name="p_scnt_' + i +'"/></label> <a href="#" id="remScnt">Remove</a></p><img id="preview' + i +'" src="#" style="width: 200px;"/>').appendTo(scntDiv);
//         i++;
//         return false;
//     });
    
//     $('#remScnt').live('click', function() { 
//         if (i > 2) {
//             $(this).parents('p').remove();
//             i--;
//         }
//         return false;
//     });
// });
// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $('#preview' + i).attr('src', e.target.result);
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }
// $("#p_scnt").change(function(){
//     readURL(this);
//     console.log(this);
// });
</script>
@stop