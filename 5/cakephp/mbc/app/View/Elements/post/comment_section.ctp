                                <!-- start here-->
                                <div ng-repeat="d in data">
                                        <div class="chat-rbox">
                                            <ul class="chat-list p-0">
                                                <li>
                                                    <div class="chat-img"><img ng-src="/img/blog/{{d.User.image}}" alt="user" /></div>
                                                    <div class="chat-content">
                                                        <h5>{{ d.User.fullname }}</h5><span class="sl-date">{{ d.PostComment.created }}</span>
                                                        <div class="box bg-light-info">{{ d.PostComment.description }}</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- <dir-pagination-controls></dir-pagination-controls> -->
                                    </div>
                                <!-- end here-->
<script>
$(function () {  
    $('.comment_section').hide();
});

//------------------------------- Beginning Comment Functions ---------------------------------------------/
    var app = angular.module('myComment', []);
    app.controller('commentCtrl', function($scope, $http) {
    $scope.show_comment = function(post_id){
            data = {
                    'post_id' : post_id
                }
                $.ajax({
                    data : data,
                    type: 'post',
                    url:'/show-comment',
                    async:false,
                    success:function(response){
                        let commentData = JSON.parse(response);
                                $('.comment_section').hide();
                                $(`#comment_section_${post_id}`).show();
                                $scope.data = commentData;
                                comment().count(post_id);
                    }
                });
        };
    });


    function comment() {  
        return{
            add: function (post_id, this_comment) {
                data  = {
                    post_id     : post_id,
                    description : $(`#comment_description${this_comment}`).val()
                }
                try {
                    $.ajax({
                        data : data,
                        type: 'post',
                        url : '/add-comment',
                        async:false,
                        success:function(success){
                            if (!(success));
                            $(`#comment_description${this_comment}`).val('');
                        }
                    });
                } catch (error) {
                    
                }
            },
            count: function (post_id) {  
                let data = {
                    post_id : post_id
                } 
                try {
                    $.ajax({
                        data:data,
                        type:'post',
                        url: 'count-comment',
                        async:false,
                        success:function(result){
                            $(`#comment_post${post_id}`).html(`[${result}]`);
                        }
                    });
                } catch (error) {
                    
                }
            }
        }        
    }
//------------------------------- End Comment Functions ---------------------------------------------/
</script>