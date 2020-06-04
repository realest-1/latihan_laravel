//navbar active class change
$(document).ready(function() {
    var pathname = window.location.pathname;
	$('.navbar-nav > li > a[href="'+pathname+'"]').addClass('active');
    $( ".mr-auto .nav-item" ).bind( "click", function(event) {
        window.location.href = $(event.target).attr('href');
        var clickedItem = $( this );
        $( ".navbar-nav .nav-item" ).each( function() {
            $( this ).removeClass( "active" );
        });
        clickedItem.addClass( "active" );
    });
});

//article modal display
$(document).ready(function(){
    //get the clicked element value
    $("[name='pop']").on("click", function () {
        $(this).addClass('article-trigger-clicked');
        var options = {
            'backdrop': 'dynamic'
          };
        $('#artModal').modal(options);
    });
    // on modal show
    $('#artModal').on('show.bs.modal', function() {
        var id = $(".article-trigger-clicked").attr('id');
        var title = $('#title'+id).text();
        var article = $('#article'+id).attr('value');
        var edit = $('#edit'+id).attr('href');
        var artDelete = $('#delete'+id).attr('action');

        if(typeof edit == 'undefined') {
            $('#artEdit').hide();
            $('#artDelete').hide();
        }

        $('#artTitle').text(title);
        $('#artArticle').html(article);
        $('#artEdit').attr('href', edit);
        $('#artDelete').attr('action', artDelete);
    });
    // on modal hide
    $('#artModal').on('hide.bs.modal', function() {
        $('.article-trigger-clicked').removeClass('article-trigger-clicked')
    })
});
