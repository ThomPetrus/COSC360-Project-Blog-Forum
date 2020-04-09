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

$(function () {
    categorySelect();
    hideExcessComments();
    initHiddenElements();
    expanderButtons();
});


function hideExcessComments(){
    $('.forum-content-container').each(function(index){
        $('.post-'+(index+1)).each(function(commentIndex , comment){
            if(commentIndex > 1){
               comment.classList.add("hidden-comment-"+(index+1));
            }
        });
    });
}

function categorySelect(){
    
    var $selectedCategory=1;

    // For each button, when clicked set selected category to that category id value
    $('.category-btn').each(function(index){
        $("#catId-"+(index+1)).on('click', function(){
            $selectedCategory = index+1;
            categoryShow($selectedCategory);
        });
    });
}

function categoryShow($selectedCategory){

    // Only if a category is selected - otherwise show all
    if($selectedCategory != 0){
        $('.forum-content-container').each(function(index, element){
            if(element.id != "catId-"+$selectedCategory){
                element.hidden = true;
            } else {
                element.hidden = false;
            }
        });
    } else {
        return;
    }
}

function initHiddenElements(){
    $('#about-us-panel').hide();
    $('#categories-panel').hide();
    $('.comment').hide();
    $('.portfolio-add-post').hide();
    $('.edit-portfolio-btn').hide();
    $('.delete-portfolio-btn').hide();
    $('.forgot-pass-form').hide();
    $('.edit-portfolio-post-form').hide();
    $('.delete-portfolio-post-form').hide();
    $('.delete-forum-post-form').hide();
    $('.delete-post-comment-form').hide();
    $('.edit-profile-form').hide();
    $('.edit-carousel-form').hide();
    
    $(".all-comment-expander").each(function(index) {
        $(".hidden-comment-"+(index+1)).hide();
    }); 
}


// For the sliding buttons used all over 
function expanderButtons(){

    $('.expander').on('click', function () {
        $('#about-us-panel').slideToggle();
    });

    $('.category-expander').on('click', function () {
        $('#categories-panel').slideToggle();
    });

    $(".add-comment-expander").each(function(index) {
        $("#expander-"+(index+1)).on('click', function(){
            $("#add-comment-"+(index+1)).slideToggle();
        });    
    });    
    
    $(".all-comment-expander").each(function(index) {
        $("#comment-expander-"+(index+1)).on('click', function(){
            $(".hidden-comment-"+(index+1)).slideToggle();
        });    
    }); 

    // portfolio post
    $('.add-post-expander').on('click', function () {
        $('.portfolio-add-post').slideToggle();
    });

    // Edit portfolio - show individual buttons
    $('.edit-portfolio-btn-expander').on('click', function(){
        $('.edit-portfolio-btn').slideToggle();
    });

    // Edit portfolio
    $('.edit-carousel-btn').on('click', function(){
        $('.edit-carousel-form').slideToggle();
    });

    $('.edit-profile-btn').on('click', function(){
        $('.edit-profile-form').slideToggle();
    });

    $('.edit-portfolio-post-btn').each(function(index){
        $("#edit-post-"+(index+1)).on('click', function(){
            $("#form-"+(index+1)).slideToggle();
        });   
    });
    
    $('.delete-portfolio-post-btn').each(function(index){
        $("#delete-post-"+(index+1)).on('click', function(){
            $("#delete-form-"+(index+1)).slideToggle();
        });   
    });

    $('.delete-forum-post-btn').each(function(index){
        $("#delete-forum-post-"+(index+1)).on('click', function(){
            $("#delete-form-"+(index+1)).slideToggle();
        });   
    });

    $('.delete-post-comment-btn').each(function(index){
        $("#delete-post-comment-"+(index+1)).on('click', function(){
            $("#delete-post-comment-form-"+(index+1)).slideToggle();
        });   
    });

    $('#forgot-pass-btn').on('click', function(){
        $('.forgot-pass-form').slideToggle();
    });
}