<div>
    <div class='main__link-to-TinTuc-container'>
        <a href="http://localhost/BMW/TinTuc/NewsList" class='main__link-to-TinTuc-link'>
            <button class='main__link-to-TinTuc-btn'> << Xem toàn bộ tin tức</button>
        </a>
    </div>

    <div class="main__title-header">
        <h2 class="main__title-heading">Sửa Tin Tức</h2>
    </div>

    <div class="main__form-container">
        <form action="" method="post" id="form_update_tintuc" class="main__form">
            <div class="form__group">
                <label for="title">Tiêu đề (*): </label>
                <textarea name="title" id="title" placeholder="Nhập tiêu đề" required></textarea>
            </div>
            <div class="form__group">
                <label for="categories_update">Thể loại: </label>
                <select name="categories_update" id="categories_update">
                    <option value="" disabled>Chọn thể loại</option>
                </select>
            </div>
            <div class="form__group">
                <label for="content">Nội dung (*): </label>
                <textarea name="content" id="content" cols="30" rows="10" required></textarea>
            </div>
            <div class="form__group">
                <label for="image">Hình ảnh: </label>
                <div class="form__group-tintuc-image-container">
                    <img src="#" alt="no image" id="image" class="form__group-tintuc-image">
                </div>
                <div class="form__group-tintuc-imageName-container">   
                    <input type="text" name="imageName" id="imageName" class="form__group-tintuc-imageName-input" readonly>
                </div>
                
                <div class="form__group-tintuc-image-editBtn-container">
                    <input type="button" value="Edit Image" id="edit_image" class="form__group-tintuc-image-editBtn">
                </div>
                <div id="container-changeImage">
                </div>
            </div>
            <div class="form__group">
                <input type="submit" value="UPDATE" name="update">
            </div>
        </form>
    </div>
    
</div>

<script>

    var obj=<?php 
            if (isset($data['itemTin']))
                echo $data['itemTin']; 
            else 
                echo "null";
        ?>;

    var theloaiList=document.querySelector('#categories_update');
    var arrCategories = <?php echo $data["arrCategories"]; ?>;
    var arrCategoriesMap=arrCategories.map(function(item) {
        if (item["id"]==obj["idloai"]) {
            return `<option selected value="${item["id"]}">${item["theloai"]}</option>`;
        }
        return `<option value="${item["id"]}">${item["theloai"]}</option>`;
    });
    var htmls=arrCategoriesMap.reduce(function(acc, item) {
        return acc+item;
    },"");
    theloaiList.innerHTML+=htmls;

    var formElement=document.querySelector('#form_update_tintuc');
    formElement.setAttribute('action', `../XuLySuaTinTuc/${obj["id"]}`);
    formElement.querySelector('textarea[id="title"]').value=obj["tieude"];
    formElement.querySelector('textarea[id="content"]').innerHTML=obj["noidung"];
    formElement.querySelector('img#image').setAttribute('src', `http://localhost/BMW/public/images/${obj["hinhanh"]}`);
    formElement.querySelector('input[id="imageName"]').value=obj["hinhanh"];

    // edit hinh anh
    var btnEditImage=document.querySelector('input[id="edit_image"]');
    btnEditImage.onclick=function(e) {
        e.target.setAttribute('disabled', true);
        var changeImageBlock=document.querySelector('#container-changeImage');
        changeImageBlock.innerHTML=`
            <div>
                <input type='file' name="image_file_change" id="image_file_change">
                <input type="button" value="Cancel" id="cancel_changeImage">
                <input type="button" value="Delete image" id="delete_changeImage">
            </div>
        `;

        // nhan nut cancel
        var btnCancel_changeImage=e.target.parentNode.parentNode.querySelector('#cancel_changeImage');
        btnCancel_changeImage.onclick=function(e) {
            e.target.parentNode.parentNode.parentNode.querySelector('input[id="edit_image"]').removeAttribute('disabled');
            e.target.closest('.form__group').querySelector('input[id="imageName"]').value=obj["hinhanh"];
            var imgChangeElement=e.target.closest('.form__group').querySelector('img#image');
            imgChangeElement.setAttribute('src', `http://localhost/BMW/public/images/${obj["hinhanh"]}`);
            e.target.parentNode.remove();
        }

        // change image
        var inputFileImg=e.target.parentNode.parentNode.querySelector('input[id="image_file_change"]');
        inputFileImg.onchange=function(e) {
            var imageName=e.target.files[0].name;
            var imgChangeElement=e.target.closest('.form__group').querySelector('img#image');
            imgChangeElement.setAttribute('src', `http://localhost/BMW/public/images/${imageName}`);
            e.target.closest('.form__group').querySelector('input[id="imageName"]').value=imageName;
        }

        // xoa image
        var btnDelete_changeImage=e.target.closest('.form__group').querySelector('#delete_changeImage');
        btnDelete_changeImage.onclick=function(e) {
            var imgChangeElement=e.target.closest('.form__group').querySelector('img#image');
            imgChangeElement.setAttribute('src', '#');
            e.target.closest('.form__group').querySelector('input[id="imageName"]').value="";
        }

    }
</script>