/* jQuery and JavaScript code here for lab6-1.html */

/*
<aside class="edit-buttons">
        <h2>Edit Portfolio Mode</h2>
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">+ Empty Module</button>
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">+ Image</button>
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">+ Video</button>
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">+ Text</button>
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">~ Change Profile Info</button>
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">~ Change Module Content</button>
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">- Exit Edit Mode</button>
    </aside>
*/



$(document).ready(function () {
    // Responsive Images Function - are anonymous functions used by convention? - looks messy?
    $("#edit-button").click(function (e) {

        
        // make dynamic element with larger preview image and caption
        var preview = $('<div id="preview"></div>');
        var image = $('<img src="' + newsrc + '">');
        var caption = $('<p>' + alt + '</p>');

        // Change thumbnail to gray
        $(this).attr("class", $(this).attr("class") + " gray");

        // Display Preview Image
        $(this).after(preview);
        preview.append(image);
        preview.append(caption);
        preview.fadeIn(1000);
        s
    });

    $(".img-responsive").on("mouseleave", function (e) {
        // Change thumbnail to gray
        $(this).attr("class", $(this).attr("class").replace(" gray", ""));

        $("#preview").fadeOut(1000);
        $("#preview").remove();

    });
})


function createButton($btnText, $btnFunction){
    $btnSpace = $('#edit-button-space');
    $btn = $('<button class="btn btn-secondary my-2 my-sm-0" type="submit">'+$btnTxt+'</button>');
    $btn.attr("action=\""+$btnFunction+"\"");
    $btnSpace.append($btn);
}