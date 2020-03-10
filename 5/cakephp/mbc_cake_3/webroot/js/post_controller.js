//--------------------------------- Beginning POST Functions --------------------------------------/
$(document).ready(function () {
    $( ".comment" ).dblclick(function() {
        $('.comment_section').fadeOut();
    });
});
    function post() {
        return {
            delete: function(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) { 
                        data = {
                        'id' : id
                        }
                        $.ajax({
                            data : data,
                            type : 'post',
                            url : '/mbc/delete-post',
                            success:function (success) { 
                                let redirect = false;
                                if (success) {
                                    message().delete_success();
                                    redirect = true;
                                } else {
                                    message().failed();
                                    redirect = false;
                                }
                                if (success == 'invalid') {
                                    message().bad();
                                    redirect = false;
                                }
                                if (redirect) {
                                    setTimeout(function() {
                                        $(location).attr('href','/mbc/Posts');
                                    }, 1000);
                                }
                            }
                        });
                    }    
                });
            },
            update:function(post_id, description, image) {
                console.log(post_id, description, image);
                $('#update_description').val(description);
                $('#update_post_id').val(post_id);
                $('#update_image_temp').val(image);
            },
            share: function(user_id, parent_post_id, description, image) {
                let data = {
                    'parent_post_id' : parent_post_id
                };
                $('#parent_post_id').val(parent_post_id);
            },
            like: function(post_id) {
                data = {
                    'post_id' : post_id
                }
                $.ajax({
                    data : data,
                    type : 'post',
                    url  : '/mbc/like-post',
                    success: function (response) {  
                        if(response){
                            post().show_like(post_id);
                        }
                    },
                    error:function(response){
                        console.log('Already like this post so this will convert to unlike');
                        post().unlike(post_id);
                    }
                });
            },
            unlike: function(post_id) {
                data = {
                    'post_id' : post_id
                }
                $.ajax({
                    data : data,
                    type : 'post',
                    url  : '/mbc/unlike-post',
                    success: function (response) {  
                        if(response){
                            post().show_like(post_id);
                        }
                    },
                    error:function(response){
                        console.log('Ops something went wrong');
                    }
                });
            },
            show_like: function(post_id) {
                data = {
                    'post_id' : post_id
                }
                $.ajax({
                    data : data,
                    type :'post',
                    url  :'/mbc/count-post-like',
                    success: function(response){
                        $(`#like_post${post_id}`).html(` ${response}`);
                    }
                });
            }
        }
    }
//---------------------------------- End POST Functions ------------------------------------------/

//------------------------------ Beginning Messages Functions -------------------------------------/
    function message() {
        return {
            delete_success: function() {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
            },
            failed: function() {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: 'Please Try again later!!'
                    })
            },
            bad: function () {  
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'You are trying to delete other user properties',
                    footer: 'Please try again and be honest. Thank you!!'
                    })
            }
        }
}
//---------------------------------- End Messages Functions -------------------------------------------/