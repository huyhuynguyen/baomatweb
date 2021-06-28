<div>
    <div>
        <a href="http://localhost/BMW/TinTuc/NewsList">Xem toàn bộ tin tức</a>
    </div>
    <div id="detail-tintuc"></div>

    <h4>Bình luận (<span id="sumOfCommentAndRep"></span>)</h4>
    <div>
        <div class="write__comment">
            <img src="#" id="avatar" alt="" width="37px" height="37px">
            <div>
                <textarea name="comment" id="" cols="60" rows="2"></textarea>
                <button id="send__comment">Gửi</button>
            </div>
        </div>

        <div class="view__comment">
            <ul class="list__comment"></ul>
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
                            <li>
                                <div>
                                    <img src="http://localhost/BMW/public/images/${phanhoi["avatar"]}" alt="" width="37px" height="37px">
                                    <h5>${phanhoi["fullname"]}</h5>
                                    <p>${phanhoi["noidung"]}</p>
                                </div>
                            </li>
                        `;
                    });
                    phanhoiElement=arrPhanHoi.reduce(function(acc, phanhoi) {
                        return acc+phanhoi;
                    },"");
                }
                return `
                    <li data=${comment["id"]}>
                        <div>
                            <img src="http://localhost/BMW/public/images/${comment["avatar"]}" alt="" width="37px" height="37px">
                            <h5>${comment["fullname"]}</h5>
                            <p>${comment["noidung"]}</p>
                        </div>
                        <div>
                            <span class="response__comment">Trả lời</span>
                        </div>
                        <div class="response__container">
                            <div style="display: none;" class="input__write-response">
                                <textarea name="response" id="" cols="60" rows="2"></textarea>
                                <button class="send__response">Gửi</button>
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
            htmls="<ul class='list__comment'>No comment</ul>";
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
    var obj=<?php 
            if (isset($data['itemTin']))
                echo $data['itemTin']; 
            else 
                echo "null";
        ?>;
    var htmls="";
    if (obj==null) {
        htmls=`<p> No News </p>`;
    }
    else {
        htmls=`
            <h4>${obj["tieude"]}</h4>
            <p>Thể loại: ${obj["theloai"]}</p>
            <p>${obj["noidung"]}</p>
            <div>
                <img src="http://localhost/BMW/public/images/${obj["hinhanh"]}" alt="">
            </div>
        `;
    }
    itemTinTuc.innerHTML=htmls;

    
    // hiển thị comment và response
    var arrComment=<?php echo $data["arrComment"]; ?>;
    var sumOfCommentAndRepElement=document.querySelector('#sumOfCommentAndRep');
    var sum=0;
    // console.log(arrComment);
    var commentListElement=document.querySelector('.list__comment');
    sum+=arrComment.length;
    var commentShowObject=HienThi(arrComment);
    if (arrComment.length>0) {
        commentListElement.innerHTML=commentShowObject["htmls"];
    }
    else {
        commentListElement.parentNode.innerHTML=commentShowObject["htmls"];
    }
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
                        var commentListElement=document.querySelector('.list__comment');
                        if (commentListElement.innerText=="No comment") {
                            console.log(1);
                            commentListElement.innerHTML=`
                                <li data="${data["id"]}">
                                    <div>
                                        <img src="http://localhost/BMW/public/images/${currentUser["avatar"]}" alt="" width="37px" height="37px">
                                        <h5>${currentUser["fullname"]}</h5>
                                        <p>${data["noidung"]}</p>
                                    </div>
                                    <div>
                                        <span class="response__comment">Trả lời</span>
                                    </div>
                                    <div class="response__container">
                                        <div style="display: none;" class="input__write-response">
                                            <textarea name="" id="" cols="60" rows="2"></textarea>
                                            <button class="send__response">Gửi</button>
                                        </div>
                                        <ul class="list__response">
                                            
                                        </ul>
                                    </div>
                                </li>
                            `;
                        }
                        else {
                            commentListElement.innerHTML+=`
                                <li data="${data["id"]}">
                                    <div>
                                        <img src="http://localhost/BMW/public/images/${currentUser["avatar"]}" alt="" width="37px" height="37px">
                                        <h5>${currentUser["fullname"]}</h5>
                                        <p>${data["noidung"]}</p>
                                    </div>
                                    <div>
                                        <span class="response__comment">Trả lời</span>
                                    </div>
                                    <div class="response__container">
                                        <div style="display: none;" class="input__write-response">
                                            <textarea name="" id="" cols="60" rows="2"></textarea>
                                            <button class="send__response">Gửi</button>
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
                                        dataType: 'text',
                                        data: {
                                            noidung: commentContentElement.value.trim(),
                                            username: currentUser["username"],
                                            idcomment: e.target.closest('li[data]').getAttribute('data')
                                        },
                                        success: function(data) {
                                            sum+=1;
                                            responseListElement.innerHTML+=`
                                                <li>
                                                    <div>
                                                        <img src="http://localhost/BMW/public/images/${currentUser["avatar"]}" alt="" width="37px" height="37px">
                                                        <h5>${currentUser["fullname"]}</h5>
                                                        <p>${data}</p>
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
                    dataType: 'text',
                    data: {
                        noidung: commentContentElement.value.trim(),
                        username: currentUser["username"],
                        idcomment: e.target.closest('li[data]').getAttribute('data')
                    },
                    success: function(data) {
                        sum+=1;
                        responseListElement.innerHTML+=`
                            <li>
                                <div>
                                    <img src="http://localhost/BMW/public/images/${currentUser["avatar"]}" alt="" width="37px" height="37px">
                                    <h5>${currentUser["fullname"]}</h5>
                                    <p>${data}</p>
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