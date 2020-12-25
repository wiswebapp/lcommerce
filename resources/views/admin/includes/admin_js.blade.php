<script>
    function removeData(routeUrl,dataId){
        
        if(confirm('Are you sure you want to delete ?')){
            $.ajax({
                type : "POST",
                url : ''+routeUrl+'',
                data : {
                    "_token": "{{ csrf_token() }}",
                    dataId:dataId
                },
                success : function(response) {
                    location.reload();
                }
            });
        }
    }
    
</script>