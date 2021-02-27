<script>

function removeData(dataType,dataId){
    if (confirm("Are you sure to remove " + dataType + " ?") == true) {
        if(dataType == "product"){
            routeUrl = '{{route('admin.destroy_product')}}';
        }else if(dataType == "category"){
            routeUrl = '{{route('admin.destroy_category')}}';
        }else if(dataType == "subcategory"){
            routeUrl = '{{route('admin.destroy_subcategory')}}';
        }else if(dataType == "user"){
            routeUrl = '{{route('admin.destroy_user')}}';
        }else if(dataType == "admin"){
            routeUrl = '{{route('admin.destroy_admin')}}';
        }
    }
    removeDataFromDB(routeUrl ,dataId);
}
function removeDataFromDB(routeUrl,dataId){
    $.ajax({
        type : "DELETE",
        url : routeUrl,
        data : {
            dataId:dataId
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success : function(response) {
            if(response){
                alert("Data has been removed");
                location.reload(); 
            }
        }
    });
}

function setCategory(selectedId=''){
    $.ajax({
        type : "POST",
        url : '{{route('ajax.getCat')}}',
        data : {
            selectedId:selectedId
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success : function(response) {
            if(response.success){
                $("#category").html(response.subCatData);
            }
        }
    });
}
function setSubCategory(categoryId,selectedId=''){
    if(categoryId != ''){
        //Method1
        $.ajax({
            type : "POST",
            url : '{{route('ajax.getSubCat')}}',
            data : {
                categoryId:categoryId,
                selectedId:selectedId
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response) {
                if(response.success){
                    $("#subCategory").html(response.subCatData);
                }else{
                    $("#subCategory").html("<option>Whoops</option>");
                }
            }
        });
        
    }
}
</script>