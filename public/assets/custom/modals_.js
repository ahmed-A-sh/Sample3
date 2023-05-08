var err_msg     = "حدثت مشكلة ، يرجى المحاولة مرة اخرى ";
var success_msg = "تمت العملية بنجاح";

function getModalContent(sourceUrl, modalWrapper, Title,modalSize) {
    $(modalWrapper + ' .modal-dialog').addClass(modalSize);
    $(modalWrapper).modal('show');
    $(modalWrapper + " .modal-title").html(Title);
    $(modalWrapper + " .modal-body").html("<h1>الرجاء الانتظار قليلا....</h1>");
    $.ajax({
        method: "GET",
        url: sourceUrl,
        data :{'IsModel' :true}
    }).done(function (result) {
        var parsed = $.parseHTML(result);
        datatable = $(parsed).find(".data-table");
        if(datatable.length)
            FnDataTable(datatable)
        result = $(parsed).find(".main-content");
        // $(result).removeClass('card');
        $(result).find('.card').removeClass('card');
        $(result).find('.card-header').remove();
        footer = $(result).find('.modal-footer')
        if(footer.length){
            $(modalWrapper + " .modal-footer").html(footer.html());
        }else {
            $(modalWrapper + " .modal-footer").remove()
        }
        $(modalWrapper + " .modal-body").html(result);
        if($('.DropzoneCont').length){
            initDropZone();
        }
        footer.remove();
    })
        .fail(function () {
            $(modalWrapper).modal('hide');
        });
}

function initDropZone(){
    new Dropzone(".DropzoneCont", {
        url: UrlForScripts + '/uploadFilesDZ', // Set the url for your upload script location
        paramName: "uploaded_files", // The name that will be used to transfer the file
        uploadMultiple: true,
        maxFiles: 100,
        maxFilesize: 100, // MB
        addRemoveLinks: true,
        parallelUploads:36,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        acceptedFiles:"image/*,application/pdf,image/webp",
        // accept: function(file, done) {
        //     if (file.name == "wow.jpg") {
        //         done("Naha, you don't.");
        //     } else {
        //         done();
        //     }
        // }
    }).on("successmultiple", function(files, response) {
        // console.log(files,response)
        $('.DropzoneCont').parents('form').find('.uploaded_files_names').val(response.result);

    });

}
$(document).on("click", ".openModal", function (e) {
    e.preventDefault();
    var title = $(this).attr("data-title");
    var href = $(this).attr("href");
    var modalSize = $(this).attr("data-size");
    getModalContent(href, "#OpenModal", title,modalSize);
});


$(document).on("click", ".OpenModal-lv-1", function (e) {
    e.preventDefault();
    var title = $(this).attr("data-title");
    var href = $(this).attr("href");
    var modalSize = $(this).attr("data-size");
    getModalContent(href, "#OpenModal-lv-1", title,modalSize);
});

$(document).on("click", ".OpenModal-lv-2", function (e) {
    e.preventDefault();
    var title = $(this).attr("data-title");
    var href = $(this).attr("href");
    var modalSize = $(this).attr("data-size");
    getModalContent(href, "#OpenModal-lv-2", title, modalSize);
});
$(document).on("click", ".OpenModal-lv-3", function (e) {
    e.preventDefault();
    var title = $(this).attr("data-title");
    var href = $(this).attr("href");
    var modalSize = $(this).attr("data-size");
    getModalContent(href, "#OpenModal-lv-3", title, modalSize);
});
$(document).on("click", ".OpenModal-lv-4", function (e) {
    e.preventDefault();
    var title = $(this).attr("data-title");
    var href = $(this).attr("href");
    var modalSize = $(this).attr("data-size");
    getModalContent(href, "#OpenModal-lv-4", title, modalSize);
});

function toast(type, message) {
    /* type = (error, info, warning, success) */
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-top-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    Command: toastr[type](message);
}

function Confirm(title,text,Confirmed,NotConfirme){
    Swal.fire({
        title: title,
        text: text ,
        icon: "success",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "<i class='las la-check-circle'></i> نعم ",
        cancelButtonText: '<i class="las la-times-circle"></i> لا',
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-default"
        }
    }).then(function(result){
        if(result.isConfirmed){
            Confirmed()
        }else if(result.dismiss == 'cancel'){
            NotConfirme()
        }
    })
}


$(document).on("click", ".btn-search", function (){
    var form =  $(".search-form");
    $.ajax({
        url     : form.attr("action"),
        type    : form.attr("method"),
        beforeSend: function(){
            //console.log( this.data );
        },
        data    : form.serialize(),
        success : function ( json )
        {
            if( $('.data-table').length ) // use this if you are using id to check
            {
                $('.data-table').DataTable().ajax.url("?system_id=2&IsDataTable=true").load();
            }
        },
        error   : function ( jqXhr, json, errorThrown )
        {
            var errors = jqXhr.responseJSON;
            console.log(errors);
        }
    });
});



$(document).on("click", ".btn-save", function (){
    var form =  $(".submit-form");

    form.attr('disabled', true);
    $(this).attr('disabled', true);
    $("*").removeClass('is-invalid');
    $(".submit-form .text-muted").html('')
    $.ajax({
        url     : form.attr("action"),
        type    : form.attr("method"),
        beforeSend: function(){
            //console.log( this.data );
        },
        data    : form.serialize(),
        success : function ( json )
        {
            if( $('#OpenModal').length )
            {
                $("#OpenModal").modal('hide');
            }
            if( $('.data-table').length )         // use this if you are using id to check
            {
                $('.data-table').DataTable().ajax.reload();
            }else{
                location.reload();
            }
        },
        error   : function ( jqXhr, json, errorThrown )
        {
            form.attr('disabled', false);
            $(this).attr('disabled', false);
            var errors = jqXhr.responseJSON;
            if(jqXhr.status == 422){
                $.each(errors.errors, function( key, value ) {
                    var _tag="input[name="+key+"]";
                    var _tag2="select[name="+key+"]";
                    $(_tag).addClass('is-invalid');
                    $(_tag).siblings('.text-muted').html(value);
                    $(_tag2).addClass('is-invalid');
                    $(_tag2).siblings('.text-muted').html(value);
                });
            }
        }
    });
});

function AjaxRequest(type,ajaxurl,formData,successCallback,errorCallback){
    $.ajax({
        type: type,
        url: ajaxurl,
        data: formData,
        dataType: 'json',
        success: successCallback,
        error: errorCallback
    });
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    complete: function(result, textStatus) {
        if(result.status == 200 ){
            if(isJson(result.responseText)){
                var data = JSON.parse(result.responseText);
                if(data.hasOwnProperty("message"))
                {
                    toast("success", data.message);
                }
            }
        }else if(result.status == 422 ){
            //validation error
        }else{
            toast("error", err_msg);
        }
    }
});


$(document).on('click',".btn_del_html",function (){
    $(this).parents('.del_from_here').remove();
})
function FnDataTable (dtable){
    var route =  dtable.data('url');
    var table = dtable.DataTable({
        processing: true,
        serverSide: true,
        ajax: ((route.indexOf("?") == -1) ? (route+"?IsDataTable=true") : (route+"&IsDataTable=true")),
        language: {
            "paginate": {
                "first":      "الأول",
                "last":       "الأخير",
                "previous": "السابق",
                "next": "التالي"
            },
            "decimal":        "",
            "emptyTable":     "لا يوجد بيانات",
            "info":           "عرض _START_ الى _END_ من _TOTAL_ عنصر ",
            "infoEmpty":      "اظهار 0 ال 0 من 0 عنصر",
            "infoFiltered":   "( تم البحث في _MAX_ عنصر )",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "عرض _MENU_ من الصفوف",
            "loadingRecords": "جاري التحميل ، يرجى الانتظار.............",
            "processing":     "جاري التنفيذ ....",
            "search":         "بحث : ",
            "zeroRecords":    "لم يتم العثور على نتائج",
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    });
}


