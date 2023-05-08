/**

 * Created by ahmed on 05/01/2017.

 */

$body = $("body");

$(document).on({

    ajaxStart: function () {
        $body.addClass("loading");
    },

    ajaxStop: function () {
        $body.removeClass("loading");
    }

});


$(function () {
    $body.removeClass("loading");
    $body.removeClass("page-loading");
    // $("select:not('.noSel'):not('.swal2-select')").select2({
    //     width: 'resolve',
    //     placeholder: "الرجاء الاختيار",
    //     minimumResultsForSearch: 8
    // });
    $("*[data='has_date_picker']").flatpickr();

    $('area').on('focusout', function () {
        if ($(this).parents('.has_error')) {
            $(this).parents('.has_error').find(".has-error").remove();
            $(this).parents('.has_error').removeClass('has_error');
        }
    });
    $('select').on('focusout', function () {
        if ($(this).parents('.has_error')) {
            $(this).parents('.has_error').find(".has-error").remove();
            $(this).parents('.has_error').removeClass('has_error');
        }
    });


    $('input').on('focusout', function () {
        var parent = $(this).parents('.has_error');
        if (parent) {
            parent.removeClass('has_error');
            parent.find(".has-error").remove();
        }
    });
    jQuery(document).on('change', '.upload_image', function () {

        var parent = $(this).parents('.imageCont');


        if (parent.hasClass('has_error')) {
            console.log(parent, parent.find(".has-error"));

            parent.removeClass('has_error');
            parent.find(".has-error").remove();
        }
    });

    $('.reset_field').click(function () {

        $(this).siblings("input").val('');

    });

    $('.btn-reset').click(function () {

        // $(this).siblings("input").val('');
        $('.btn-reset').parents('form').find("input").each(function (){
            $(this).val('');
        });
        $(this).parents('form').find("select").each(function (){

            if($(this).val() != 0 && $(this).val() !='' && $(this).val() !=-1){
                $(this).val(0);
            }


        });
        $(this).parents('form').submit()
    });

    $('.autoSubmit').on('change',

        function () {

            $body.addClass("loading");


            $(this).parents('form').submit();

        });


    $('.normalLink').on('click',

        function (evt) {

            if (evt.ctrlKey)

                return;

            if (evt.altKey)

                return;

            if (evt.shiftKey)

                return;

            $body.addClass("loading");


        });


    $('.CheckedItem').on('click', function () {

        var candel = $(this).data('candel');

        if (candel == 1 || candel == 2) {

            if ($(this).is(':checked')) {

                if (candel == 2) {

                    $('.DeleteFrmSelect').hide();

                    var oldcount = $('.DeleteFrmSelect').data('lock_count') > 0 ? $('.DeleteFrmSelect').data('lock_count') : 0;

                    $('.DeleteFrmSelect').data('lock_count', oldcount + 1);


                }


            } else {

                if (candel == 2) {

                    var oldcount = $('.DeleteFrmSelect').data('lock_count');

                    if (oldcount == 1) {

                        $('.DeleteFrmSelect').show();


                    }

                    $('.DeleteFrmSelect').data('lock_count', oldcount - 1);


                }

            }

        }

    });

    // $(':required').each(function () {
    //
    //     var $from_p = $(this).parent().find('label');
    //
    //     if ($from_p.length > 0) {
    //
    //         $from_p.append('<span class="required_star">*</span>');
    //
    //
    //     } else {
    //
    //         $(this).parent().parent().find('label').append('<span class="required_star">*</span>');
    //
    //     }
    //
    // })

    // $('.make-switch').bootstrapSwitch();


    $('.MainImageSelect').click(function (e) {

        e.preventDefault();

        $('#imagePrev').empty();

        var par = $(this).data('parent');

        var name = $(this).data('inputname');

        var val = $("input[name='" + name + "']").val();

        if (val) {

            var values = JSON.parse(val);

            for (var i = 0; i < values.length; ++i) {

                $('#imagePrev').append(
                    '<div class="My_image_prev">' +

                    '<img class="MaInImgSelCted" data-img="' + values[i] + '" data-where="' + par + '" src="' + UrlForAssets + '/uploads/' + values[i] + '"  >' +

                    '</div>'
                );

            }

        }


    })

    $("body").on('click', '.btn-doAction',

        function () {

            var desc = $(this).data('desc') ? $(this).data('desc') : '';

            var Id = $(this).data('id');

            var url = $(this).data('url');

            var token = $(this).data('token');

            var thisF = $(this);

            Swal.fire(
                {

                    title: "هل انت متأكد ؟",

                    text: "هل تريد بالتأكيد القيام بالاجراء" + '   ' + desc,

                    icon: "warning",

                    showCancelButton: 1,

                    confirmButtonText: "نعم , قم بالاجراء !",

                    cancelButtonText: "لا, الغي العملية !",

                    reverseButtons: 1

                }).then(function (e) {


                if (e.value) {


                    $.post(url,

                        {

                            _token: token,

                            id: Id,

                        },

                        function (data, status) {

                            if (data.done == 1) {

                                Swal.fire({

                                    title: 'تم القيام بالعملية بنجاح',

                                    text: data.msg,

                                    icon: 'success',

                                    timer: 2000,

                                    showConfirmButton: false

                                }).then(
                                    function () {

                                        location.reload(true);

                                    }
                                )

                            } else {


                                Swal.fire({

                                    title: 'حدث خطأ ما',

                                    text: data.msg,

                                    icon: 'error',

                                    timer: 4000,

                                    showConfirmButton: false

                                })


                            }

                        }).fail(function (data2, status) {

                        var data2 = data2.responseJSON;

                        Swal.fire({

                            title: 'خطأ',

                            text: data2.response_message,

                            icon: 'error',

                            timer: 4000,

                            showConfirmButton: false

                        })

                    });


                } else {

                    e.dismiss && Swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");


                }

            });


        });

    $('body').on('click', '.SelIMg', function () {

        $('#imagePrev').empty();

        var par = $(this).data('parent');

        var val = $("input[name='uploaded_multi_image_name']").val();

        if (val) {

            var values = JSON.parse(val);

            for (var i = 0; i < values.length; ++i) {

                $('#imagePrev').append(
                    '<div class="My_image_prev">' +

                    '<img class="ImgSelCted" data-img="' + values[i] + '" data-where="' + par + '" src="' + UrlForAssets + '/uploads/' + values[i] + '"  >' +

                    '</div>'
                );

            }


        }


    }).on('click', '.ImgSelCted', function () {


        var par = $(this).data('where');

        var img = $(this).data('img');

        $('#imgSel').val(img);

        $('#ChickIfImageSelected').show();

        $('#CloSEForm').click();


    }).on('click', '.MaInImgSelCted', function () {


        var img = $(this).data('img');

        $('.uploaded_image_def').val(img);

        $('#ChickIfImageSelected2').show();

        $('#DefaultImagePrev').attr('src', UrlForAssets + '/uploads/' + img);

        $('#CloSEForm').click();


    });


    $("body").on('click', '*[data-table-action="delete_row"]',

        function (e) {
            e.preventDefault();
            var desc = $(this).data('desc') ? $(this).data('desc') : '';
            var Id = $(this).data('id');
            var url = $(this).data('url');
            var token = $(this).data('token');
            var thisF = $(this);
            let parentMenu=$(this).parents('td').find('.btn-menu');
            Swal.fire(
                {
                    title: "هل انت متأكد ؟",
                    text: "هل تريد بالتأكيد حذف العنصر" + '   ' + desc,
                    icon: "warning",
                    showCancelButton: 1,
                    confirmButtonText: "نعم , قم بالحذف !",
                    cancelButtonText: "لا, الغي العملية !",

                }).then(function (e) {
                if (e.value) {


                    parentMenu.attr('data-kt-indicator', 'on').addClass('disabled')
                    $.post(url,
                        {
                            _token: token,
                            id: Id,
                        },
                        function (data, status) {
                            if (data.done == 1) {
                                Swal.fire({
                                    title: 'تم الحذف بنجاح',
                                    text: data.msg,
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(
                                    function () {
                                        parentMenu.attr('data-kt-indicator', 'off').removeClass('disabled')
                                        var ra = thisF.parents('tr');
                                        var d = thisF.parents('.productItem');
                                        var table = thisF.parents('table');
                                        d.css('background', 'rgba(255,0,0,0.53)').fadeOut(600);
                                        ra.css('background', 'rgba(255,0,0,0.53)').fadeOut(600, function () {
                                            ra.remove();
                                            var num = 1;
                                            table.find('.LOOPIDS').each(function () {
                                                $(this).text(num);
                                                num = num + 1;
                                            });
                                        });
                                    }
                                )

                            } else {
                                parentMenu.attr('data-kt-indicator', 'off').removeClass('disabled')

                                Swal.fire({
                                    title:data.title||'حدث خطأ ',
                                    text: data.message||'ما',
                                    icon: 'error',
                                    timer: 4000,
                                    showConfirmButton: false
                                })
                            }

                        }).fail(function (data2, status) {
                        var data2 = data2.responseJSON;
                        Swal.fire({
                            title: 'خطأ',
                            text: data2.response_message,
                            icon: 'error',
                            timer: 4000,
                            showConfirmButton: false
                        })
                    });
                } else {
                    e.dismiss && Swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");
                }
            });
        });

    $("body").on('click', '*[data-table-action="action"]',

        function (e) {
            e.preventDefault();
            var desc = $(this).data('desc') ? $(this).data('desc') : '';
            var Id = $(this).data('id');
            var url = $(this).data('url');
            var token = $(this).data('token');
            var thisF = $(this);
            let parentMenu=$(this).parents('td').find('.btn-menu');
            Swal.fire(
                {
                    title: "هل انت متأكد ؟",
                    text: "هل تريد بالتأكيد نفيذ العملية" + '   ' + desc,
                    icon: "warning",
                    showCancelButton: 1,
                    confirmButtonText: "نعم , قم بالتنفيذ !",
                    cancelButtonText: "لا, الغي العملية !",

                }).then(function (e) {
                if (e.value) {


                    parentMenu.attr('data-kt-indicator', 'on').addClass('disabled')
                    $.post(url,
                        {
                            _token: token,
                            id: Id,
                        },
                        function (data, status) {
                            if (data.done == 1) {
                                Swal.fire({
                                    title: 'تم تفيذ العملية بنجاح',
                                    text: data.msg,
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(
                                    function () {
                                        let id=thisF.data('actionid');
                                        let newtext=thisF.data('actionnewtext');
                                        let removeclass=thisF.data('actionremoveclass');
                                        let addclass=thisF.data('actionaddclass');
                                        let thisnewtext=thisF.data('thisnewtext');
                                        let thisoldtext=thisF.text();
                                        if(id&&newtext){
                                            let oldtext=$('#'+id).text();
                                            $('#'+id).text(newtext);
                                            thisF.data('actionnewtext',oldtext)
                                            if(removeclass && addclass){
                                                $('#'+id).removeClass(removeclass).addClass(addclass);
                                                thisF.data('actionremoveclass',addclass)
                                                thisF.data('actionaddclass',removeclass)
                                            }
                                            thisF.text(thisnewtext);
                                            thisF.data('thisnewtext',thisoldtext);
                                            parentMenu.attr('data-kt-indicator', 'off').removeClass('disabled')
                                            return;
                                        }
                                        location.reload();
                                    }
                                )

                            } else {
                                parentMenu.attr('data-kt-indicator', 'off').removeClass('disabled')

                                Swal.fire({
                                    title:data.title||'حدث خطأ ',
                                    text: data.message||'ما',
                                    icon: 'error',
                                    timer: 4000,
                                    showConfirmButton: false
                                })
                            }

                        }).fail(function (data2, status) {
                        var data2 = data2.responseJSON;
                        Swal.fire({
                            title: 'خطأ',
                            text: data2.response_message,
                            icon: 'error',
                            timer: 4000,
                            showConfirmButton: false
                        })
                    });
                } else {
                    e.dismiss && Swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");
                }
            });
        });

    $("body").on('click', '.btn_addToList',

        function () {

            var selecttxt = $('.RetSelect').val();

            var select = $('#' + selecttxt);

            var url = select.data('addurl');

            var token = select.data('token');

            var name = $('#name_ar_to_add').val();

            var name_en = $('#name_en_to_add').val();

            var image = $('#image').val();

            console.log(name, name_en);

            if (name == '') {

                alert('الرجاء ادخال الاسم');

                return;

            }

            if (name_en == '') {

                alert('Please enter the name');

                return;

            }


            if (image == '') {

                alert('Please enter the image');

                return;

            }


            $.post(url,

                {

                    _token: token,

                    name_ar: name,

                    name_en: name_en,

                    image: image,

                },

                function (data, status) {

                    if (data.done == 1) {

                        select.html(data.out).niceSelect('update');

                        $('#AddNewModal').modal('hide');

                        Swal.fire({

                            title: 'تمت الاضافة بنجاح',

                            text: 'تمت الاضافة بنجاح',

                            icon: 'success',

                            timer: 2000,

                            showConfirmButton: false

                        })

                        $('#name_ar_to_add').val('');

                        $('#name_en_to_add').val('');

                        $('#image').val('');


                    } else {


                        Swal.fire({

                            title: 'حدث خطأ ما',

                            text: 'خطأ مجهول',

                            icon: 'error',

                            timer: 4000,

                            showConfirmButton: false

                        })


                    }

                })


        });


    $("body").on('click', "[data-value='9911Add_NeW_tO_The_LiST9911']",

        function () {


            var select = $(this).parents('.form-group').find('select');

            select.val(0).niceSelect('update');

            var thisF = $(this);

            $('.RetSelect').val(select.attr('id'));

            $('#name_ar_to_add').val('');

            $('#name_en_to_add').val('');

            $('#AddNewModal').modal('show');


        });


    $(document).on('click', '.DelImage', function (e) {

        e.preventDefault();

        var token = jQuery('input[name=_token]').val();

        var url = $(this).data('url');
        var is_main = $(this).data('is_main');

        var image = $(this).data('image');

        var my_button = $(this);


        Swal.fire(
            {

                title: "هل انت متأكد ؟",

                text: "هل تريد بالتأكيد حذف الصورة",

                icon: "warning",

                showCancelButton: 1,

                confirmButtonText: "نعم , قم بالحذف !",

                cancelButtonText: "لا, الغي العملية !",

                reverseButtons: 1

            }).then(function (e) {


            if (e.value) {

                $.post(url,

                    {

                        _token: token,

                        image: image,

                    },

                    function (data, status) {

                        if (data.status == 1) {


                            $('.MultiImagePrev').html(data.out);

                            $('.multimg_container').trigger("ImagesChange");
                            if (is_main) {

                                defDeleted = 1;

                                $('.uploaded_image_def').val('');

                                my_button.parents('.multimg_container').find('#DefaultImagePrev').attr('src', UrlForAssets + '/blank.png');

                            }


                        } else {

                        }

                    });


            } else {

                e.dismiss && Swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");


            }

        });


    });

    $(document).on('click', '.DelImageCreate', function (e) {

        e.preventDefault();


        var image = $(this).data('image');

        var my_button = $(this);

        var def = $('.uploaded_image_def').val();

        var defDeleted = 0;

        if (image == def) {

            defDeleted = 1;

            $('.uploaded_image_def').val('');

            my_button.parents('.multimg_container').find('#DefaultImagePrev').attr('src', UrlForAssets + '/blank.png');

        }

        var images = JSON.parse($('.uploaded_multi_image_name').val());

        var newImages = [];

        for (var i = 0; i < images.length; i++) {

            if (images[i] != image) {

                newImages.push(images[i]);

                if (defDeleted) {

                    $('.uploaded_image_def').val(images[i]);

                    defDeleted = 0;

                    my_button.parents('.multimg_container').find('#DefaultImagePrev').attr('src', UrlForAssets + '/uploads/' + images[i]);

                }

            }

        }

        $('.uploaded_multi_image_name').val(JSON.stringify(newImages));


        // this project only


        var imageName = image.split(".")[0];

        var toRem = $('.IMGCONT_' + imageName);

        if (toRem.length) {

            toRem.remove();

        }

        $(this).parents('.edit_images').remove();


    });

    $(document).on('click', '.SetAsDefault', function (e) {

        e.preventDefault();

        var token = jQuery('input[name=_token]').val();

        var url = $(this).data('url');

        var image = $(this).data('image');

        var my_button = $(this);

        Swal.fire(
            {

                title: "هل انت متأكد ؟",

                text: "هل تريد بالتأكيد تغيير الصورة الافتراضية",

                icon: "warning",

                showCancelButton: 1,

                confirmButtonText: "نعم , قم بالتغيير !",

                cancelButtonText: "لا, الغي العملية !",

                reverseButtons: 1

            }).then(function (e) {


            if (e.value) {

                $.post(url,

                    {

                        _token: token,

                        image: image,

                    },

                    function (data, status) {

                        if (data.status == 1) {

                            $('#DefaultImagePrev').attr('src', data.default);

                            $('.MultiImagePrev').html(data.out);

                            my_button.parents('.multimg_container').find('.uploaded_multi_image_name').trigger("ImagesChange");


                        } else {

                        }

                    }
                );


            } else {

                e.dismiss && Swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");


            }

        });

    });


    jQuery('.uploaded_image_name').on('change', function () {

        var value = $(this).val();

        if (ValidURL(value)) {

            jQuery('.MyImagePrivew').show().attr('src', value);

        }

    });

    function ValidURL(str) {

        var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol

            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|' + // domain name

            '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address

            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path

            '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string

            '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locater

        if (!pattern.test(str)) {

            return false;

        } else {

            return true;

        }

    }


    jQuery(document).on('change', '.upload_image', function () {
        var my_files = this.files;
        var my_button = jQuery(this);
        var size = false;
        var type = false;
        var fd = new FormData();
        for (var i = 0; i < my_files.length; ++i) {
            var temp = my_files[i];
            var file_name = temp.name;
            var temp_size = parseInt(temp.size) / 1024;
            var extension = file_name.substr((file_name.lastIndexOf('.') + 1)).toLowerCase();
            if (extension === 'jpg' || extension === 'jpeg' || extension === 'png' || extension === 'gif')
                type = true;
            if (temp_size <= 8192)
                size = true;
            fd.append("uploaded_file", my_files[i]);
            fd.append("_token", jQuery('input[name=_token]').val());
        }

        if (size && type) {
            jQuery.ajax({
                url: UrlForAssets + '/uploadFile',
                type: 'POST',
                data: fd,
                cache: true,
                contentType: false,
                processData: false,
                dataType: "json",
                xhr: function () {
                    return new window.XMLHttpRequest();
                },
                beforeSend: function (XMLHttpRequest) {
                    $('body').removeClass("loading");
                    my_button.parent().find('.image-spiner').show();
                    my_button.parent().find('.img-icon').hide();
                },
                success: function (data) {
                    flag = true;
                    if (data.status == 1) {
                        my_button.parent().find('.image-spiner').hide();
                        my_button.parent().find('.img-icon').show();
                        my_button.parent().parent().find('.image-preview').show().attr('src', data.filelink);
                        my_button.parent().parent().find('.final-input').val(data.file_name).hide();
                    } else {
                        Swal.fire("خطأ", "خطأ من الخادم", "error")

                    }
                }
            });
        } else {
            flag = true;
            if (size > 4192)
                Swal.fire("خطأ", "حجم الملف كبير جدا", "error")
            if (type == false)
                Swal.fire("خطأ", "الرجاء ادخال صور فقط", "error")
        }

    });


    jQuery(document).on('change', '.upload_image_multi', function () {

        var my_files = this.files;

        var my_button = jQuery(this);

        var size = false;

        var extension = 0;

        var type = false;

        var fd = new FormData();

        for (var i = 0; i < my_files.length; i++) {

            var temp = my_files[i];

            var file_name = temp.name;

            var temp_size = parseInt(temp.size) / 1024;

            var extension = file_name.substr((file_name.lastIndexOf('.') + 1)).toLowerCase();

            if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'gif')

                type = true;

            // my_button.parents('.multimg_container').find();

            if (temp_size <= 8192)

                size = true;


            fd.append("uploaded_files[]", my_files[i]);

            fd.append("_token", jQuery('input[name=_token]').val());

            fd.append("oldData", my_button.parents('.multimg_container').find('.uploaded_multi_image_name').val());

        }

        if (size && type) {

            jQuery.ajax({

                url: UrlForScripts + '/uploadFiles',

                type: 'POST',

                data: fd,

                cache: false,

                contentType: false,

                processData: false,

                dataType: "json",

                xhr: function () {

                    var xhr = new window.XMLHttpRequest();

                    // jQuery('.upload_progress').css('display', 'block');


                    xhr.upload.addEventListener('progress', function (e) {

                        if (e.lengthComputable) {

                            // var prog = (e.loaded / e.total) * 100 + '%';

                            // jQuery('.upload_progress').find('.progresspar-upload').css('width', prog);

                        }

                    }, false);


                    return xhr;

                },

                beforeSend: function (XMLHttpRequest) {

                    $('body').removeClass("loading");

                    my_button.parents('.multimg_container').find('.MutiImageTextIcon').removeClass('fa-image').addClass('fa-spinner fa-spin');

                    my_button.parents('.multimg_container').find('.upload-image-error-msg-validation').remove();

                },

                success: function (data) {

                    flag = true;

                    // jQuery('.upload_progress').css('display', 'none');

                    // jQuery('.upload_progress').find('.progresspar-upload').css('width', 0);

                    if (data.status == 1) {

                        var imgs = '';

                        var out = data.links;

                        var firstIMG = '';

                        var firstIMGurl = '';

                        for (var i = 0; i < out.length; i++) {

                            imgs = imgs + '<div class="edit_images">\n' +

                                '                <img src="' + out[i] + '" class="Muti-Image-prev" alt="">\n' +

                                '                <div class="actions">\n' +

                                '                    <a href="#" class="DelImageCreate" data-image="' + data.resultNames[i] + '" title="حذف"\n' +

                                '                       style="color: red;cursor: pointer;font-size: 1.2em;text-decoration: none;">\n' +

                                '                        <i class="fa fa-trash "></i>\n' +

                                '                    </a>\n' +

                                '                </div>\n' +

                                '            </div>';

                            if (firstIMG == '') {

                                firstIMG = out[i];

                                firstIMGurl = data.resultNames[i];

                            }

                        }

                        my_button.parents('.multimg_container').find('.uploaded_multi_image_name').val(data.result);

                        my_button.parents('.multimg_container').trigger("ImagesChange");


                        my_button.parents('.multimg_container').find('.MutiImageTextIcon').removeClass('fa-spinner fa-spin').addClass('fa-image');


                        my_button.parents('.multimg_container').find('.MultiImagePrev').html(imgs);

                        my_button.parents('.multimg_container').find('#DefaultImagePrev').attr('src', firstIMG);

                        my_button.parents('.multimg_container').find('.uploaded_image_def').val(firstIMGurl);

                    } else {

                        alert('هناك خطأ ما !');

                        my_button.parents('.multimg_container').find('.progresspar-region').addClass('display-none');


                        my_button.parents('.multimg_container').find('.progresspar-region').find('.progresspar-upload').css('width', 0);

                        my_button.parents('.multimg_container').find('.MutiImageTextIcon').removeClass('fa-spinner fa-spin').addClass('fa-times');


                    }

                },

                error: function (data) {

                    alert('هناك خطأ ما !');

                    my_button.parents('.multimg_container').find('.progresspar-region').addClass('display-none');


                    my_button.parents('.multimg_container').find('.progresspar-region').find('.progresspar-upload').css('width', 0);

                    my_button.parents('.multimg_container').find('.MutiImageTextIcon').removeClass('fa-spinner fa-spin').addClass('fa-times');


                }

            });

        } else {

            alert('هناك خطأ ما !');

            flag = true;

            my_button.parents('.multimg_container').find('.upload-image-error-msg-validation').remove();

            if (size > 8192)

                my_button.parents('.multimg_container').find('.imageContainer').append('<span class="upload-image-error-msg-validation">حجم الملف كبير جدا</span>');


            if (type == false)

                my_button.parents('.multimg_container').find('.imageContainer').append('<span class="upload-image-error-msg-validation">الرجاء ادخال صور فقط</span>');


        }

    });

    jQuery(document).on('change', '.upload_image_multi2', function () {

        var my_files = this.files;

        var my_button = jQuery(this);

        var url = $(this).data('url');

        var place = $(this).data('place');

        var size = false;

        var extension = 0;

        var type = false;

        var fd = new FormData();

        for (var i = 0; i < my_files.length; i++) {

            var temp = my_files[i];

            var file_name = temp.name;

            var temp_size = parseInt(temp.size) / 1024;

            extension = file_name.substr((file_name.lastIndexOf('.') + 1)).toLowerCase();

            if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'gif')

                type = true;


            if (temp_size <= 8192)

                size = true;


            fd.append("uploaded_files[]", my_files[i]);

            fd.append("_token", jQuery('input[name=_token]').val());

            fd.append("place", place);

        }

        if (size && type) {

            jQuery.ajax({

                url: url,

                type: 'POST',

                data: fd,

                cache: false,

                contentType: false,

                processData: false,

                dataType: "json",

                xhr: function () {

                    var xhr = new window.XMLHttpRequest();

                    xhr.upload.addEventListener('progress', function (e) {

                        if (e.lengthComputable) {

                            var prog = (e.loaded / e.total) * 100 + '%';

                            jQuery('.progresspar-region').find('.progresspar-upload').css('width', prog);

                        }

                    }, false);


                    return xhr;

                },

                beforeSend: function (XMLHttpRequest) {

                    $('body').removeClass("loading");

                    my_button.parents('.multimg_container').find('.MutiImageTextIcon').removeClass('fa-image').addClass('fa-spinner fa-spin');

                    my_button.parents('.multimg_container').find('.upload-image-error-msg-validation').remove();

                },

                success: function (data) {

                    flag = true;

                    if (data.status == 1) {


                        my_button.parents('.multimg_container').find('.MutiImageTextIcon').removeClass('fa-spinner fa-spin').addClass('fa-image');


                        my_button.parents('.multimg_container').find('.MultiImagePrev').html(data.out);

                        // my_button.parents('.multimg_container').find('.uploaded_multi_image_name').val(data.result);

                        my_button.parents('.multimg_container').find('.uploaded_multi_image_name');

                        my_button.parents('.multimg_container').trigger("ImagesChange");


                    } else {

                        alert('something goes wrong !');

                    }

                }

            });

        } else {

            flag = true;

            alert('something goes wrong !');

            $('.upload-image-error-msg-validation').remove();

            if (size > 8192)

                $('.imageContainer').append('<span class="upload-image-error-msg-validation">حجم الملف كبير جدا</span>');


            if (type == false)

                $('.imageContainer').append('<span class="upload-image-error-msg-validation">الرجاء ادخال صور فقط</span>');


        }

    });


    $('#SelectAll').on('click', function () {

        if ($(this).is(':checked')) {

            $('.CheckedItem').each(function (i) {

                $(this).prop("checked", true);

            });

        } else {

            $('.CheckedItem').each(function (i) {

                $(this).prop("checked", false);

            });

        }


    });

    var table = document.getElementById('showTable');

    // Select elements
    var toolbarBase = document.querySelector('[data-table-toolbar="base"]');
    var toolbarSelected = document.querySelector('[data-table-toolbar="selected"]');
    var selectedCount = document.querySelector('[data-table-select="selected_count"]');
    // Init toggle toolbar
    var initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        if(table){
            const checkboxes = table.querySelectorAll('[type="checkbox"]');

            // Toggle delete selected toolbar
            checkboxes.forEach(c => {
                // Checkbox on click event
                c.addEventListener('click', function () {
                    setTimeout(function () {
                        toggleToolbars();
                    }, 50);
                });
            });
        }

    }

    // Toggle toolbars
    const toggleToolbars = () => {
        // Select refreshed checkbox DOM elements
        if (table) {

            const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

            // Detect checkboxes state & count
            let checkedState = false;
            let count = 0;

            // Count checked boxes
            allCheckboxes.forEach(c => {
                if (c.checked) {
                    checkedState = true;
                    count++;
                }
            });

            // Toggle toolbars
            if (checkedState) {
                selectedCount.innerHTML = count;
                toolbarBase.classList.add('d-none');
                toolbarSelected.classList.remove('d-none');
            } else {
                toolbarBase.classList.remove('d-none');
                toolbarSelected.classList.add('d-none');
            }
        }
    }
    toggleToolbars();
    initToggleToolbar();

    $('.btn-bulk-action').on('click', function () {
        var val = [];
        $('.CheckedItem:checked').each(function (i) {
            val[i] = $(this).val();
        });
        var desc = $(this).data('desc') ? $(this).data('desc') : '';
        var url = $(this).data('url');
        var token = $(this).data('token');
        let btn=$(this);
        Swal.fire(
            {
                title: "هل انت متأكد ؟",
                text: "هل تريد بالتأكيد تنفيذ العملية على العناصر المحددة" + '   ' + desc,
                icon: "warning",
                showCancelButton: 1,
                confirmButtonText: "نعم , قم بالعملية !",
                cancelButtonText: "لا, الغي العملية !",
                reverseButtons: 1
            }).then(function (e) {
            if (e.value) {
                btn.attr('data-kt-indicator', 'on').addClass('disabled')

                $.post(url,
                    {
                        _token: token,
                        id: val,
                    },
                    function (data, status) {
                        btn.attr('data-kt-indicator', 'off').removeClass('disabled')
                        if (data.done == 1) {

                            if (url.indexOf('delete') !== -1) {
                                Swal.fire({
                                    title: 'تم تنفيذ العملية بنجاح',
                                    text: 'تم تنفيذ العملية بنجاح',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(
                                    function () {


                                        for (var i = 0; i < val.length; i++) {
                                            var ra = $('#TR_' + val[i]);
                                            ra.css('background', 'rgba(255,0,0,0.53)').fadeOut(600, function () {
                                                ra.remove();
                                                toggleToolbars();
                                                initToggleToolbar();
                                            });
                                        }
                                        var table = $('#showTable');
                                        var num = 1;
                                        table.find('.LOOPIDS').each(function () {
                                            $(this).text(num);
                                            num = num + 1;
                                        });
                                        toggleToolbars();
                                        initToggleToolbar();
                                    }
                                )
                            } else {
                                Swal.fire({
                                    title: 'تم تنفيذ العملية بنجاح',
                                    text: 'تم تنفيذ العملية بنجاح',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(
                                    function () {
                                        location.reload()
                                    });
                            }
                        }else{
                            Swal.fire({
                                title:data.title||'حدث خطأ ',
                                text: data.message||'ما',
                                icon: 'error',
                                timer: 4000,
                                showConfirmButton: false
                            })
                        }
                    });
            } else {

                e.dismiss && Swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");
            }
        });
    });


});



