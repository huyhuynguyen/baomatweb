<div>
    <div class="main__title-header">
        <h2 class="main__title-heading">Tìm kiếm</h2>
    </div>

    <div class="main__form-search-container">
        <div id="form__search" class="main__form-search">
            <input type="search" name="search" id="search" value="<?php echo $_SESSION["timkiem"]; ?>" placeholder="Tìm kiếm" class="main__form-search-input">
            <img src="https://img.icons8.com/material-outlined/24/000000/search--v1.png" class="main__form-search-icon">
        </div>
    </div>

    <div class="main__form-search-number-result-container">
        <p class="main__form-search-number-result">Có <span id="number_searchItem"></span> kết quả tìm kiếm</p>
    </div>
    
    <div class="main__list-tintuc-container">
        <ul class="search-result__container"></ul>
    </div>
</div>

<script>
    var arr=<?php echo $data["arrSearchTintuc"]; ?>;
    // so luong kq tim kiem
    var numberResultElement=document.querySelector('#number_searchItem');
    numberResultElement.innerHTML=arr.length;

    if (arr.length>0) {
        // hien thi kq tim kiem
        var ulElement=document.querySelector('.search-result__container');
        var arrItem=arr.map(function(item) {
            return `
                <li dataId="${item["id"]}" class="list-tintuc-item">
                    <div class="list-tintuc-item-image-container">
                        <a href="http://localhost/BMW/TinTuc/Detail/${item["id"]}">
                            <img src="http://localhost/BMW/public/images/${item["hinhanh"]}" alt="image" class="list-tintuc-item-image">
                        </a>
                    </div>
                    <h4 class="list-tintuc-item-header">
                        <p class="list-tintuc-item-heading">
                            <a href="http://localhost/BMW/TinTuc/Detail/${item["id"]}" class="list-tintuc-item-heading-link">${item["tieude"]}</a>
                        </p>
                        <?php
                            if (isset($_SESSION["role"]) && $_SESSION["role"]==0) 
                                echo "
                                    <div>
                                        <button class='edit_Tintuc'>Edit</button> 
                                        <button class='delete_Tintuc'>Delete</button>
                                    </div>
                                ";
                        ?>
                        
                    </h4>
                </li>
            `;
        });
        var htmls=arrItem.reduce(function(acc, item) {
            return acc+item;
        }); 
        ulElement.innerHTML=htmls;
    }

    // delete tin tức
    var arr_btnDelete_Tintuc=document.querySelectorAll('.delete_Tintuc');
    arr_btnDelete_Tintuc.forEach(function(btnDelete) {
        btnDelete.onclick=function(e) {
            e.target.parentNode.parentNode.parentNode.remove();
        }

        $(document).ready(function() {
            $(btnDelete).click(function(e) {
                $.ajax({
                    url: 'http://localhost/BMW/TinTuc/XoaTinTuc',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: e.target.closest('li').getAttribute('dataId')
                    },
                    success: function(data) {
                        
                    }
                })
            })
        })
    })

    // edit tin tức
    var arr_btnEdit_Tintuc=document.querySelectorAll('.edit_Tintuc'); 
    arr_btnEdit_Tintuc.forEach(function(btnEdit) {
        btnEdit.onclick=function(e) {
            var idTin=e.target.parentNode.parentNode.parentNode.getAttribute('dataId');
            window.location=`http://localhost/BMW/TinTuc/SuaTinTuc/${idTin}`;
        }
    })

    // search tin tức
    var inputSearch=document.querySelector('input[id="search"]');
    inputSearch.onfocus=function() {
        inputSearch.onkeydown=function(e) {
            // Enter trong input
            if (e.keyCode==13) {
                var textToSearch=e.target.value.trim();
                if (textToSearch=="")
                    alert("Nhập thông tin tìm kiếm");
                else 
                    window.location=`http://localhost/BMW/TimKiem/Search/${textToSearch}`;
            }
        }
    }
</script>