<div>
    <div class="main__title-header">
        <h2 class="main__title-heading">Tin Tức</h2>
    </div>

    <div class="main__form-search-container">
        <div id="form__search" class="main__form-search">
            <input type="search" name="search" id="search" placeholder="Tìm kiếm" class="main__form-search-input">
            <img src="https://img.icons8.com/material-outlined/24/000000/search--v1.png" class="main__form-search-icon">
        </div>
    </div>
    
    <?php
        // admin 
        if (isset($_SESSION["role"]) && $_SESSION["role"]==0) 
            echo "
                <div class='main__addTinTuc-container'>
                    <a href='http://localhost/BMW/TinTuc/ThemTinTuc' class='main__addTinTuc-link'>
                        <button id='create_news' class='main__addTinTuc-btn'>Thêm tin tức</button>
                    </a>
                </div>
            ";
    ?>
    
    

    <div class="main__list-tintuc-container">
        <div class="main__list-tintuc-title-filter-container">
            <div class="main__list-tintuc-title-container">
                <p class="main__list-tintuc-title">Các tin tức hiện có</p>
            </div>
            <div class="main__list-tintuc-filter-container">
                <p>Chọn thể loại</p>
                <select name="main__list-tintuc-filter" id="tintuc-filter" class="main__list-tintuc-filter">
                    <option value="all">Tất cả</option>
                </select>
            </div>
        </div>
        
        <ul class="list-tintuc"></ul>
    </div>
    
</div>

<script>
    // hiển thị tất cả các thể loại
    var arrTheLoai=<?php echo $data["arrTheLoai"]; ?>;
    var selectTheLoaiElement=document.querySelector('select[id="tintuc-filter"]');
    var arrItemTheLoai=arrTheLoai.map(function(element) {
        return `
            <option value="${element["id"]}">${element["theloai"]}</option>
        `;
    });
    var htmls=arrItemTheLoai.reduce(function(acc, item) {
        return acc+item;
    },"");
    selectTheLoaiElement.innerHTML+=htmls;

    // filter các tin tức theo thể loại
    selectTheLoaiElement.onchange=function(e) {
        $.ajax({
            url: 'http://localhost/BMW/TinTuc/SelectedTheLoai',
            type: 'post',
            dataType: 'json',
            data: {
                theloai: e.target.value,
            },
            success: function(data) {
                var tintucList=document.querySelector('.list-tintuc');
                
                var arrItem=data.map(function(item) {
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
                tintucList.innerHTML=htmls;

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
                            else {
                                window.location=`http://localhost/BMW/TimKiem/Search/${textToSearch}`;
                            }
                                
                        }
                    }
                }
            }
        })
    }




    var arr = <?php echo $data["arrTinTuc"]; ?>;
    if (arr.length>0) {
        // hiển thị tất cả các tin tức
        var tintucList=document.querySelector('.list-tintuc');
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
        tintucList.innerHTML=htmls;
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
                else {
                    window.location=`http://localhost/BMW/TimKiem/Search/${textToSearch}`;
                }
                    
            }
        }
    }
    
</script>