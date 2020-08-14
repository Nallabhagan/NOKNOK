<script type="text/javascript">
    $(document).on('click','.follow',function(){
        var following_id = $(this).attr("data-id");
        $("#follow_status").html('<button data-id="'+following_id+'" class="unfollow btn btn-primary btn-sm font-weight-bold ml-2 mb-1"><i class="icon-feather-user-check"></i> following</button>');
        $.ajax({
            url: "{{ route('follow') }}",
            method: "POST",
            data: {
                "following_id": following_id,
                "_token": $('input[name=_token]').val()
            },
            success:function(data){
            }
        });
    });

    $(document).on('click','.unfollow',function(){
        var following_id = $(this).attr("data-id");

        $("#follow_status").html('<button data-id="'+following_id+'" class="follow btn btn-primary btn-sm font-weight-bold ml-2 mb-1"><i class="icon-feather-user-x"></i> follow</button>');
        $.ajax({
            url: "{{ route('unfollow') }}",
            method: "POST",
            data: {
                "following_id": following_id,
                "_token": $('input[name=_token]').val()
            },
            success:function(data){
            }
        });
    });
</script>