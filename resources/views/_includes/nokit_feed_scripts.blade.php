@auth
<script type="text/javascript">
  $(document).on('click', '.like-button', function(event){
    event.preventDefault();

    var nokit_token = $(this).attr("nokit_token");
    var like_type = $(this).attr("like_type");
    
    if(like_type == "Like")
    {
        $(this).addClass("text-primary");
        $(this).removeAttr("like_type");
        $(this).attr("like_type","UnLike");
    } else {
        $(this).removeClass("text-primary");
        $(this).removeAttr("like_type");
        $(this).attr("like_type","Like");
    }
    $(this).toggleClass('is-active');

    $.ajax({
        url: "{{ route('like') }}",
        method: "POST",
        data:{
            "nokit_token": nokit_token,
            "like_type": like_type,
            '_token': $('input[name=_token]').val()
        }
    });
  });
  $(document).on('submit', '.commentForm', function(event) {
      event.preventDefault();
      var formId = $(this).attr("id");
      var Comment = $("#addComment"+formId).val();
      if(Comment === ""){
          alert("Enter Comment");
      }else{
          
          $("#userComments"+formId).append('<div class="post-comments-single">\
                <div class="post-comment-avatar">\
                    <img src="{{ Helper::user_profile_pic(Auth::user()->id) }}" alt="">\
                </div>\
                <div class="post-comment-text">\
                    <div class="post-comment-text-inner">\
                        <p><a href="{{ Hashids::connection('user')->encode(Auth::id()) }}" class="text-primary mr-1 font-weight-bold">{{ Auth::user()->name }}</a>'+Comment+'</p>\
                    </div>\
                    <div class="uk-text-small">\
                        <span> 1 seconds ago</span>\
                    </div>\
                </div>\
            </div>');
          $.ajax({
              url: "{{ route('comment') }}",
              method: "POST",
              data: {
                  "comment": Comment,
                  "nok_it_token": formId,
                  '_token': $('input[name=_token]').val()
              },
              success:function(data) {
                $("#addComment"+formId).val("");
              }
          });
      }
  });
  $(document).on("click", ".delete", function(event){
      event.preventDefault();
      var nokit_token = $(this).attr("nokit_token");
      $.ajax({
          url: "{{ route('delete') }}",
          method: "POST",
          data: {
              "nokit_token": nokit_token,
              '_token': $('input[name=_token]').val()
          },
          success:function(data){
              if(data == true) {
                  $("#nokit"+nokit_token).hide();
              }
          }
      });
  });
</script>
@endauth