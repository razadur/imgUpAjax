<!DOCTYPE html>
<html>
<head>
    <title>File API - FileReader as Data URL</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<style>
img.thumbnail{
    height: 180px;
    margin: 10px;
}
</style>
</head>
<body>
    <form id="imgProcess" method="post" enctype="multipart/form-data">
    <header>
        <h1>Image Upload <button id="doneProtfolio" class="btn btn-borderd" style="cursor: pointer" type="submit">Done</button></h1>
    </header>
		<article>
			<output id="result">
                <input type="text" value="0" id="count" name="count" hidden><br>
				<img id="baseImage" src="http://placehold.it/180x180" style="margin: 10px;">
				<input type="file" id="files0" name='upload[]' style="display: none"/>
			</output>
			<input type="submit" value="save"/>
		</article>
	</form>
<script>
$("#baseImage").click(function(){
    var count = $('#count').val();
    var files = 'files'+count;
    $('#'+files).click();
    fun(files);
});

$('#imgProcess').on('submit',function(e){
    $.ajax({
        url:'imgProcess.php',
        data: new FormData(this),
        type:'POST',
        contentType: false,
        cache: false,
        processData:false,
        success:function(data){
            alert(data);
        }
    });
    e.preventDefault();
});
$('#doneProtfolio').click(function(){
    $(this).hide();
});

function fun(f){
    var filesInput = document.getElementById(f);

    filesInput.addEventListener("change", function(event){

        var files = event.target.files; //FileList object
        var output = document.getElementById("result");

        for(var i = 0; i< files.length; i++)
        {
            var file = files[i];

            //Only pics
            if(!file.type.match('image'))
                continue;

            var picReader = new FileReader();

            picReader.addEventListener("load",function(event){

                var picFile = event.target;

                var div = document.createElement("div");





                div.style.float="left";
                var count = parseInt($('#count').val()) + 1 ;
                $('#count').val(count);




                div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                    "title='" + picFile.name + "'/>" +
                    '<input type="file" id="files'+count+'" name="upload[]" style="display: none" />';

                output.insertBefore(div,null);

            });
            //Read the image
            picReader.readAsDataURL(file);
        }
    });
}

</script>
</body>
</html>