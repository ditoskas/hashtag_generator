<div class="well well-lg">
    <div class="text-center">
        <h1 class="text-light-blue">Welcome to #tag Generator</h1>
        <h3 class="hidden-xs hidden-sm">Enter below a website and generate unique hashtags</h3>
        <div class="input-group ">
            <span class="input-group-addon">URL</span>
            <input type="text" class="form-control" id="txtUrl" placeholder="http://www.example.gr" >
            <div class="input-group-btn">
                <button id="btnGenerateHashtags" class="btn btn-primary" type="button">Generate</button>
            </div> <!-- div.input-group-btn -->
        </div> <!-- div.input-group -->
        <span class="text-danger" id="error-message"></span>
    </div> <!-- div.text-center -->
</div> <!-- div.well-lg -->
<div id="results" class="panel panel-primary" style="display: none;">
    <div class="panel-heading">List of Hashtags</div>
        <ul class="list-group text-center" id="list-of-hashtags">
        </ul>
</div> <!-- div.panel panel-primary -->
<div id="main-loader" class="text-center loader">
    <img src="/img/loader.gif" alt="Loading..." />
</div>

<?php
$this->append('scriptDocumentReady');
?>
$('#btnGenerateHashtags').on('click',function(){
    var textToSearch = $('#txtUrl').val();
    $('#results').hide();
    $('#list-of-hashtags').empty();
    $('#main-loader').show();

    $.ajax({
        url:'/pages/request_hashtags/',
        method: "POST",
        data:{search:textToSearch},
        dataType: "json"
    }).done(function(data){
        console.log(data);
        if (data.result.type == 'fail'){
            $('#txtUrl').parent().addClass("has-error");
            $('#error-message').text(data.result.reason);
            //fix the well height
            $('#txtUrl').parents('.well').css('padding-bottom',4);
        }
        else {
            //clear the textbox if it had error before
            $('#txtUrl').parent().removeClass("has-error");
            $('.text-danger').empty();
            //fix the well height
            $('#txtUrl').parents('.well').css('padding-bottom',24);
        }
        $('#main-loader').hide();
        if (data.result.type == 'success'){
            $('#list-of-hashtags').empty();
            $('#results').show();
            HashHandler.Collection.init(data.result.hashtags);
            HashHandler.Collection.showOnList();
        }
    });
});
<?php
$this->end();
?>