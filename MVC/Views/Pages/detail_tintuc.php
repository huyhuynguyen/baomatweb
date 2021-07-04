<div>
    <div class='main__link-to-TinTuc-container'>
        <a href="http://localhost/BMW/TinTuc/NewsList" class='main__link-to-TinTuc-link'>
            <button class='main__link-to-TinTuc-btn'> << Xem toàn bộ tin tức</button>
        </a>
    </div>

    <div id="detail-tintuc"></div>

    <div class="main__comment-response-wrapper">
        <h4 class="main__comment-response-title">Bình luận (<span id="sumOfCommentAndRep"></span>)</h4>
        <div class="main__comment-response-container">
            <div class="write__comment">
                <img src="#" id="avatar" alt="" width="37px" height="37px">
                <div class="write__comment-container">
                    <textarea name="comment" id="" placeholder="Nhập bình luận" class="write__comment-content"></textarea>
                    <button id="send__comment" class="write__comment-btn">Gửi bình luận</button>
                </div>
            </div>

            <div class="view__comment">
                <ul class="list__comment"></ul>
            </div>
        </div>
    </div>
    
</div>

<script>
    // Hiển thị các comment và phản hồi
    function HienThi(arrComment) {
        var htmls="";
        if (arrComment.length>0) {
            arrComment=arrComment.map(function(comment) {
                var arrPhanHoi=comment["arrPhanHoi"];
                sum+=arrPhanHoi.length;
                var phanhoiElement="";
                if (arrPhanHoi.length>0) {
                    arrPhanHoi=arrPhanHoi.map(function(phanhoi) {
                        return `
                            <li class="list__response-item">
                                <div class="list__response-item-response">
                                    <img src="http://localhost/BMW/public/images/${phanhoi["avatar"]}" alt="" width="37px" height="37px">
                                    <div class="item-response-container">
                                        <h5 class="item-response-fullname">${phanhoi["fullname"]}</h5>
                                        <p class="item-response-content">${phanhoi["noidung"]}</p>
                                    </div>
                                </div>
                            </li>
                        `;
                    });
                    phanhoiElement=arrPhanHoi.reduce(function(acc, phanhoi) {
                        return acc+phanhoi;
                    },"");
                }
                return `
                    <li data=${comment["id"]} class="list__comment-item">
                        <div class="list__comment-item-comment">
                            <img src="http://localhost/BMW/public/images/${comment["avatar"]}" alt="" width="37px" height="37px">
                            <div class="item-comment-container">
                                <h5 class="item-comment-fullname">${comment["fullname"]}</h5>
                                <p class="item-comment-content">${comment["noidung"]}</p>
                            </div>
                        </div>
                        <div>
                            <span class="response__comment">Trả lời</span>
                        </div>
                        <div class="response__container">
                            <div style="display: none;" class="input__write-response">
                                <div class="input__write-response-container">
                                    <textarea name="response" id="" placeholder="Nhập phản hồi" class="write__response-content"></textarea>
                                    <button class="send__response">Gửi phản hồi</button>
                                </div>
                            </div>
                            <ul class="list__response">
                                ${phanhoiElement}
                            </ul>
                        </div>
                    </li>
                `;
            });

            htmls=arrComment.reduce(function(acc, comment) {
                return acc+comment;
            });
        }
        else {
            htmls="No comment";
        }
        return {
            "htmls" : htmls,
            "sum" : sum
        }
    }





    var currentUser=<?php echo $data["currentUser"]; ?>;
    // hiển thị avatar cho user
    var avatarElement=document.querySelector('img#avatar');
    avatarElement.setAttribute('src', `http://localhost/BMW/public/images/${currentUser["avatar"]}`);

    // hiển thị tin tức
    var itemTinTuc=document.querySelector('#detail-tintuc');
    var obj=<?php echo $data['itemTin']; ?>;
    var htmls=`
        <div class="main__title-header">
            <h2 class="main__title-heading">${obj["tieude"]}</h2>
        </div>
        <div class="main__category-container">
            <p class="main__category">Thể loại: <i>${obj["theloai"]}</i></p>
        </div>
        
        <div class="main__tintuc-image-container">
            <img src="http://localhost/BMW/public/images/${obj["hinhanh"]}" alt="" class="main__tintuc-image">
        </div>

        <div class="main__content-container">
            <p class="main__content">${obj["noidung"]}</p>
        </div>
    `;
    itemTinTuc.innerHTML=htmls;

    
    // hiển thị comment và response
    var arrComment=<?php echo $data["arrComment"]; ?>;
    var sumOfCommentAndRepElement=document.querySelector('#sumOfCommentAndRep');
    var sum=0;
    // console.log(arrComment);
    var commentListElement=document.querySelector('.list__comment');
    sum+=arrComment.length;
    var commentShowObject=HienThi(arrComment);
    commentListElement.innerHTML=commentShowObject["htmls"];
    sumOfCommentAndRepElement.innerHTML=commentShowObject["sum"];

    // nhấn nút gửi bình luận
    var sendCommentElement=document.querySelector('#send__comment');
    sendCommentElement.onclick=function(e) {
        var commentContentElement=e.target.closest('div').querySelector('textarea');
        if (commentContentElement.value.trim()=="") 
            alert("Nhập nội dung bình luận");
        else {
            $(document).ready(function() {
                $.ajax({
                    url: 'http://localhost/BMW/TinTuc/InsertComment',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        noidung: commentContentElement.value.trim(),
                        username: currentUser["username"],
                        idtin: obj["id"]
                    },
                    success: function(data) {
                        sum+=1;
                        if (commentListElement.innerText=="No comment") {
                            console.log(1);
                            commentListElement.innerHTML=`
                                <li data="${data["id"]}" class="list__comment-item">
                                    <div class="list__comment-item-comment">
                                        <img src="http://localhost/BMW/public/images/${currentUser["avatar"]}" alt="" width="37px" height="37px">
                                        <div class="item-comment-container">
                                            <h5 class="item-comment-fullname">${currentUser["fullname"]}</h5>
                                            <p class="item-comment-content">${data["noidung"]}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="response__comment">Trả lời</span>
                                    </div>
                                    <div class="response__container">
                                        <div style="display: none;" class="input__write-response">
                                            <textarea name="" id="" placeholder="Nhập phản hồi" class="write__response-content"></textarea>
                                            <button class="send__response">Gửi phản hồi</button>
                                        </div>
                                        <ul class="list__response">
                                            
                                        </ul>
                                    </div>
                                </li>
                            `;
                        }
                        else {
                            commentListElement.innerHTML+=`
                                <li data="${data["id"]}" class="list__comment-item">
                                    <div class="list__comment-item-comment">
                                        <img src="http://localhost/BMW/public/images/${currentUser["avatar"]}" alt="" width="37px" height="37px">
                                        <div class="item-comment-container">
                                            <h5 class="item-comment-fullname">${currentUser["fullname"]}</h5>
                                            <p class="item-comment-content">${data["noidung"]}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="response__comment">Trả lời</span>
                                    </div>
                                    <div class="response__container">
                                        <div style="display: none;" class="input__write-response">
                                            <textarea name="" id="" placeholder="Nhập phản hồi" class="write__response-content"></textarea>
                                            <button class="send__response">Gửi phản hồi</button>
                                        </div>
                                        <ul class="list__response">
                                            
                                        </ul>
                                    </div>
                                </li>
                            `;
                        }
                        commentContentElement.value='';
                        sumOfCommentAndRepElement.innerHTML=sum;

                        // nhấn "Trả lời"
                        var responseCommentElements=document.querySelectorAll('.response__comment');
                        responseCommentElements.forEach(function(responseCommentElement) {
                            var inputShowHide=true;
                            responseCommentElement.onclick=function(e) {
                                var inputWriteResponse = e.target.closest('li').querySelector('.input__write-response');
                                inputWriteResponse.style.display= inputShowHide ? "block" : "none";
                                inputShowHide=!inputShowHide;
                            }
                        });

                        // nhấn gửi phản hồi
                        var sendResponseElements=document.querySelectorAll('.send__response');
                        sendResponseElements.forEach(function(sendResponseElement) {
                            sendResponseElement.onclick=function(e) {
                                var responseListElement=e.target.closest('.response__container').querySelector('ul.list__response');
                                var commentContentElement=e.target.closest('.input__write-response').querySelector('textarea');
                                if (commentContentElement.value.trim()=="") 
                                    alert("Nhập nội dung phản hồi");
                                else {
                                    $.ajax({
                                        url: 'http://localhost/BMW/TinTuc/InsertPhanHoi',
                                        type: 'post',
                                        dataType: 'json',
                                        data: {
                                            noidung: commentContentElement.value.trim(),
                                            username: currentUser["username"],
                                            idcomment: e.target.closest('li[data]').getAttribute('data')
                                        },
                                        success: function(data) {
                                            sum+=1;
                                            responseListElement.innerHTML+=`
                                                <li class="list__response-item">
                                                    <div class="list__response-item-response">
                                                        <img src="http://localhost/BMW/public/images/${currentUser["avatar"]}" alt="" width="37px" height="37px">
                                                        <div class="item-response-container">
                                                            <h5 class="item-response-fullname">${currentUser["fullname"]}</h5>
                                                            <p class="item-response-content">${data[data.length-1]["noidung"]}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            `;
                                            commentContentElement.value='';
                                            sumOfCommentAndRepElement.innerHTML=sum;
                                        }
                                    })
                                }   
                            }
                        })
                    }
                })
            })
        }
    }

    // nhấn "Trả lời"
    var responseCommentElements=document.querySelectorAll('.response__comment');
    responseCommentElements.forEach(function(responseCommentElement) {
        var inputShowHide=true;
        responseCommentElement.onclick=function(e) {
            var inputWriteResponse = e.target.closest('li').querySelector('.input__write-response');
            inputWriteResponse.style.display= inputShowHide ? "block" : "none";
            inputShowHide=!inputShowHide;
        }
    })

    // nhấn gửi phản hồi
    var sendResponseElements=document.querySelectorAll('.send__response');
    sendResponseElements.forEach(function(sendResponseElement) {
        sendResponseElement.onclick=function(e) {
            var responseListElement=e.target.closest('.response__container').querySelector('ul.list__response');
            var commentContentElement=e.target.closest('.input__write-response').querySelector('textarea');
            if (commentContentElement.value.trim()=="") 
                alert("Nhập nội dung phản hồi");
            else {
                $.ajax({
                    url: 'http://localhost/BMW/TinTuc/InsertPhanHoi',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        noidung: commentContentElement.value.trim(),
                        username: currentUser["username"],
                        idcomment: e.target.closest('li[data]').getAttribute('data')
                    },
                    success: function(data) {
                        sum+=1;
                        responseListElement.innerHTML+=`
                            <li class="list__response-item">
                                <div class="list__response-item-response">
                                    <img src="http://localhost/BMW/public/images/${currentUser["avatar"]}" alt="" width="37px" height="37px">
                                    <div class="item-response-container">
                                        <h5 class="item-response-fullname">${currentUser["fullname"]}</h5>
                                        <p class="item-response-content">${data[data.length-1]["noidung"]}</p>
                                    </div>
                                </div>
                            </li>
                        `;
                        commentContentElement.value='';
                        sumOfCommentAndRepElement.innerHTML=sum;
                    }
                })
            }   
        }
    })

</script>