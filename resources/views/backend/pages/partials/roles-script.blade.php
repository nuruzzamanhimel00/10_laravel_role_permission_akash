
<script>
    $(document).on('change','#permissionAll',function(e){
        e.preventDefault();
        if($(this).prop('checked')){
            //is checked
            $('input[type=checkbox]').prop('checked',true);
            // console.log('checked');
        }else{
            //uncheck
            $('input[type=checkbox]').prop('checked',false);
            // console.log('uncheck');
        }

        // console.log('change');
    });

    //single group wise  permission check
    $(document).on('change','.perGrpName',function(e){
        e.preventDefault();
        let target = $(this);
        let perGrpName = target.data('gname');
        var grpAllParTar = $("."+perGrpName);
        if(target.prop('checked')){

            grpAllParTar.prop('checked',true);
        }else{
            grpAllParTar.prop('checked',false);
        }
         // all single parmission wise all checkbox manage
         allParmissionChekboxChecked();
        // console.log(perGrpName);
    });
    // single permision change
    $(document).on('change','.singPerName',function(e){
        e.preventDefault();
        var target = $(this);
        let gname = target.data('gname');
        let pargnameid = target.data('pargnameid');
        var parCheckAry = [];
        // single parmission wise group manage
        $('.'+gname).each(function(){
            if(!$(this).prop('checked')){
                // $("#"+pargnameid).prop('checked',false);
                parCheckAry.push(0);
            }else{
                // $("#"+pargnameid).prop('checked',true);
                parCheckAry.push(1);
            }
            console.log(gname);
        });
        if($.inArray(0,parCheckAry) != -1){
            $("#"+pargnameid).prop('checked',false);
        }else{
            $("#"+pargnameid).prop('checked',true);
        }
        // all single parmission wise all checkbox manage
        allParmissionChekboxChecked();

        // console.log(parCheckAry);

    });

    function allParmissionChekboxChecked(){
    // all single parmission wise all checkbox manage
    var allSltArray = [];
            // all select check
            $('.singPerName').each(function(){
                if(!$(this).prop('checked')){
                    allSltArray.push(0);
                }else{
                    allSltArray.push(1);
                }
            });

            if($.inArray(0,allSltArray) != -1){
                $('#permissionAll').prop('checked',false);
            }else{
                $('#permissionAll').prop('checked',true);
            }

    }
</script>
