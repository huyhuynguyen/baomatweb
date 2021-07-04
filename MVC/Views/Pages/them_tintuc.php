<div>
    <?php
        if (isset($_SESSION["role"]) && $_SESSION["role"]==1) 
            header("Location: http://localhost/BMW/ErrorPage");   
    ?>
    <div class='main__link-to-TinTuc-container'>
        <a href="http://localhost/BMW/TinTuc/NewsList" class='main__link-to-TinTuc-link'>
            <button class='main__link-to-TinTuc-btn'> << Xem toàn bộ tin tức</button>
        </a>
    </div>

    <div class="main__title-header">
        <h2 class="main__title-heading">Thêm Tin Tức</h2>
    </div>

    <div class="main__form-container">
        <form action="./XuLyThemTinTuc" method="post" class="main__form">
            <div class="form__group">
                <label for="title">Tiêu đề (*): </label>
                <textarea name="title" id="title" placeholder="Nhập tiêu đề" required></textarea>
            </div>
            <div class="form__group">
                <label for="categories">Thể loại (*): </label>
                <select name="categories" id="categories">
                    <option value="" disabled>Chọn thể loại</option>
                </select>
            </div>
            <div class="form__group">
                <label for="content">Nội dung (*): </label>
                <textarea name="content" id="content" placeholder="Nhập nội dung" required></textarea>
            </div>
            <div class="form__group">
                <label for="image">Thêm hình ảnh: </label>
                <input type="file" name="image" id="image" accept="image/*">
                <div id="img_show">
                    
                </div>
            </div>
            <div class="form__group">
                <input type="submit" value="CREATE" name="create">
            </div>
        </form>
    </div>
    

    <div>
        <?php
            if (isset($_SESSION["err_createNews"])) {
                echo $_SESSION["err_createNews"];
            }
        ?>  
    </div>
</div>

<script>
    window.onload=function() {
        <?php
            if (isset($_SESSION["err_createNews"])) {
                unset($_SESSION["err_createNews"]); 
            }
        ?>
    }

    var theloaiList=document.querySelector('#categories');
    var arrCategories = <?php echo $data["arrCategories"]; ?>;
    var arrCategoriesMap=arrCategories.map((item) =>
        `<option value="${item["id"]}">${item["theloai"]}</option>`
    );
    var htmls=arrCategoriesMap.reduce(function(acc, item) {
        return acc+item;
    },"");
    theloaiList.innerHTML+=htmls;

    var imgFile=document.querySelector('input[id="image"]');
    imgFile.onchange=function(e) {
        if (e.target.files[0].type.split('/')[0]!="image") {
            alert("Please import image");
            e.target.value="";
        }
        else {
            var imgShowElement=e.target.nextElementSibling;
            var image=e.target.files[0].name;
            imgShowElement.innerHTML=`
                <div class="img_show_container">
                    <img src="http://localhost/BMW/public/images/${image}" alt="image">
                    <div>
                        <input type="button" value="Cancel" id="cancel_img_show">
                    </div>
                </div>
            `;

            var cancelImgShowElement=document.querySelector('#cancel_img_show');
            if (cancelImgShowElement) {
                cancelImgShowElement.onclick=function(e) {
                    e.target.closest('.form__group').querySelector('input[id="image"]').value="";
                    e.target.closest('.img_show_container').remove();
                }
            }
        }
    }

    
</script>