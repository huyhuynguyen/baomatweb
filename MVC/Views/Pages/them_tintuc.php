<div>
    <div>
        <a href="http://localhost/BMW/TinTuc/NewsList">Xem toàn bộ tin tức</a>
    </div>

    <h2>Thêm Tin Tức</h2>
    <form action="./XuLyThemTinTuc" method="post">
        <div class="form__group">
            <label for="title">Tiêu đề: </label>
            <input type="text" name="title" id="title" required>
        </div>
        <div class="form__group">
            <label for="categories">Thể loại: </label>
            <select name="categories" id="categories">
                <option value="" selected disabled>Chọn thể loại</option>
            </select>
        </div>
        <div class="form__group">
            <label for="content">Nội dung: </label>
            <textarea name="content" id="content" cols="30" rows="10" required></textarea>
        </div>
        <div class="form__group">
            <label for="image">Thêm hình ảnh: </label>
            <input type="file" name="image" id="image">
        </div>
        <div class="form__group">
            <input type="submit" value="Create" name="create">
        </div>
    </form>

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
</script>