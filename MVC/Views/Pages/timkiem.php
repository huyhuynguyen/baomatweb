<div>
    <h3>Tìm kiếm</h3>
    <div>
        <div id="form__search">
            <input type="search" name="search" id="search" value="<?php echo $_SESSION["timkiem"]; ?>">
        </div>
    </div>

    <p>Có <span id="number_searchItem">2</span> kết quả tìm kiếm</p>
    <div>
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
                <li dataId="${item["id"]}">
                    <h4>
                        <p>
                            <a href="http://localhost/BMW/TinTuc/Detail/${item["id"]}">${item["tieude"]}</a>
                        </p>
                        <?php
                            if (isset($_SESSION["role"]) && $_SESSION["role"]==0) 
                                echo "<div><button class='edit_Tintuc'>Edit</button> <button class='delete_Tintuc'>Delete</button></div>";
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