import $ from "jquery";       

import toast from 'toastr'

import swal from 'sweetalert';

function handleBackDrop() {
    $('#backdrop').hide();
    $("#search-customer").parent().css('z-index', 50);
    $("#result-user").hide();
    $("#search-user").parent().css('z-index', 50);
    $("#result-customer").hide();
}

$("#backdrop").on("click", function (e) {
    handleBackDrop()
});


$("#search-user").on('input', function(){
   clearTimeout(this.delay);
   this.delay = setTimeout(function(){
    const searchTerm = $("#search-user").val();
    const url = window.location.origin;
    $("#search-customer").parent().css('z-index', 0);
    if (searchTerm == "") {
        $("#memListUsers").html("");
        $("#result-user").hide();
    } else {
        $.ajax({
            type: "GET",
            data: {
                search: searchTerm,
            },
            url: `${url}/dashboard/search-user`,
            success(response) {
                if (!response.error && response !== "") {
                    $('#backdrop').show();
                    $("#memListUsers").empty().html(response);
                    $("#memListUsers .list-group-user td").on("click", function (event) {
                        const _self = event.target;
                        const userId = _self.parentElement.firstElementChild.textContent;
                        $.ajax({
                            type: "GET",
                            data: {
                                user_id: userId,
                            },
                            url: `${url}/dashboard/search-user`,
                            success(response) {
                                if (!response.error && response) {
                                    $('input[name="user_id"]').val(response.id);
                                    $('input[name="user_name"]').val(response.name);
                                    $('input[name="user_email"]').val(response.email);
                                    $('input[name="user_dob"]').val(response.dob);
                                    $('input[name="user_address"]').val(response.address);
                                    handleBackDrop()
                                }
                            },
                        });
                        
                    })
                    $("#result-user").show();
                }
                else {
                    $("#search-customer").parent().css('z-index', 50);
                    $('#backdrop').hide();
                    $("#result-user").hide();
                }
            },
        });
    }
   }.bind(this), 800);
});

function clickUser(selectors) {
    for (let i = 0; i < selectors.length; i++) {

        $(selectors[i]).on('click', function (e) {
            console.log(e);
        })
    }
}

$("#search-customer").on('input', function(){
   clearTimeout(this.delay);
   this.delay = setTimeout( function() {
    const searchTerm = $("#search-customer").val();
    const url = window.location.origin;
    $("#search-user").parent().css('z-index', 0);
    if (searchTerm == "") {
        $("#memListCustomers").html("");
        $("#result-customer").hide();
    } else {
        $.ajax({
            type: "GET",
            data: {
                search: searchTerm,
            },
            url: `${url}/dashboard/search-customer`,
            success(response) {
                if (!response.error && response !== "") {
                    $('#backdrop').show();
                    $("#memListCustomers").empty().html(response);
                    $("#memListCustomers .list-group-customer td").on("click", function (event) {
                        const _self = event.target;
                        const customerId = _self.parentElement.firstElementChild.textContent;
                        $.ajax({
                            type: "GET",
                            data: {
                                customer_id: customerId,
                            },
                            url: `${url}/dashboard/search-customer`,
                            success(response) {
                                if (!response.error && response) {
                                    $('input[name="customer_id"]').val(response.id);
                                    $('input[name="customer_name"]').val(response.name);
                                    $('input[name="customer_email"]').val(response.email);
                                    $('input[name="customer_address"]').val(response.address);
                                    $('input[name="customer_phone_number"]').val(response.phone_number);
                                    handleBackDrop()
                                }
                            },
                        });
                        
                    })
                    $("#result-customer").show();
                }
                else {
                    $('#backdrop').hide();
                    $("#search-user").parent().css('z-index', 50);
                    $("#result-customer").hide();
                }
            },
        });
    }
   }.bind(this), 800);
});

$.fn.outerHTML = function () {
    return $("<div />").append(this.eq(0).clone()).html();
};

$("tr td .btn-delete").on("click", function (event) {
    const _self = event.target;
    _self.parentElement.parentElement.remove();
});

const detailRow = $(`#import-detail .detail-row`).first();
const selectInit = $(`#import-detail .detail-row select`).first();
const allOptions = $(`#import-detail .detail-row select option`).toArray();

const updateOptionList = () => {
    const selects = $(`#import-detail .detail-row select`).toArray();
    const selectedOpt = selects.map((e, index) => $(e).val());
    selects.forEach((select, index) => {
        const valShouldRemove = selectedOpt.filter((v, i) => i != index);
        const options = $(select).find("option").toArray();
        allOptions.forEach((opt) => {
            if (!valShouldRemove.includes($(opt).attr("value"))) {
                let exist = false;
                options.forEach((opt2) => {
                    if ($(opt2).attr("value") == $(opt).attr("value")) {
                        exist = true;
                    }
                });
                if (!exist) $(select).append($(opt).outerHTML());
            } else {
                options.forEach((opt2) => {
                    if ($(opt2).attr("value") == $(opt).attr("value")) {
                        $(opt2).remove();
                    }
                });
            }
        });
    });
};

selectInit.on("change", updateOptionList);
$(".btn-add-import-detail").on("click", function (event) {
    const clone = detailRow.clone();

    const detailRows = $(`#import-detail .detail-row`).toArray();
    const selectedOptions = [];
    detailRows.forEach((row) => {
        const selectedOtp = $(row).find(`select`).val();
        selectedOptions.push(selectedOtp);
    });
    if (allOptions.length == selectedOptions.length) {
        alert('"No category left !"');
        return;
    }
    const newSelectOpts = clone.find("select option").toArray();
    newSelectOpts.forEach((opt, index) => {
        if (selectedOptions.includes($(opt).attr("value"))) {
            $(opt).remove();
        }
    });
    clone
        .on("click", function (event) {
            const _self = event.target;
            const classList = $(_self).attr("class").split(/\s+/);
            if (classList.includes("btn-delete")) {
                _self.parentElement.parentElement.remove();
            }
            updateOptionList();
        })
        .insertBefore(".detail-add");
    updateOptionList();
});
 
$("#btnImport").on("click", function (event) {
    const _self = event.target;
    const form = _self.closest("form");
    $('input[name="user_id"]').prop('disabled', false);
    $('input[name="customer_id"]').prop('disabled', false);
    form.submit();
})

$("#btnSaveChange").on("click", function (event) {
    const _self = event.target;
    const form = _self.closest("form");
    $('input[name="user_id"]').prop('disabled', false);
    $('input[name="customer_id"]').prop('disabled', false);
    form.submit();
})

$('.btn-delete-import').on('click', function (event) {
    const _self = event.target;
    const form = _self.closest('form');
            // toast.success('Delete successfully')

    swal({
        title: `Are you sure you want to delete this import?`,
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            form.submit();
            
            // toast.success('Delete successfully')
        }
    });
})
