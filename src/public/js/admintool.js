    
//set td active or normal
var ActiveRec = null;
function active_item(what) {
    
    if (ActiveRec == what)
        return;
    if (ActiveRec != null)
        ActiveRec.className = 'cell_normal';
    ActiveRec = what;
    ActiveRec.className = 'cell_active';
}

function clearValidation(formElement) {   
        //Internal $.validator is exposed through $(form).validate()
        var validator = $(formElement).validate();
        //Iterate through named elements inside of the form, and mark them as error free
        $('[name]', formElement).each(function () {
            if ($(this).hasClass('input-validation-error'))
                validator.successList.push(this);//mark as error free
            validator.showErrors();//remove error messages if present
        });

        validator.resetForm();//remove error class on name elements and clear history
        validator.reset();//remove all error and success data
   
}

function removeURLParameter(parameter) {
    var url = document.URL;
    //prefer to use l.search if you have a location/link object
    var urlparts = url.split('?');
    if (urlparts.length >= 2) {

        var prefix = encodeURIComponent(parameter) + '=';
        var pars = urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i = pars.length; i-- > 0;) {
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                pars.splice(i, 1);
            }
        }
        if (pars.join('&') != '')
            url = urlparts[0] + '?' + pars.join('&');
        else
            url = urlparts[0];
        return url;
    } else {
        return url;
    }
}

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

$(function () {
    $.validator.addMethod('date',
    function (value, element) {
        if (this.optional(element)) {
            return true;
        }
        var ok = true;
        try {
            $.datepicker.parseDate('dd/mm/yy', value);
        }
        catch (err) {
            ok = false;
        }
        return ok;
    });
    $(".datefield").datepicker({ dateFormat: 'dd/mm/yy', changeYear: true });
});

function ShowDeactive() {

    if ($('#ckbActive').prop('checked')) {
        $("td[data-isactive='0']").hide();
    }
    else {
        $("td[data-isactive='0']").show();
    }
}

/*//////////////////////////////*/
/*//////////////////////////////*/
/*Set record for control*/
function SetRecordTextBox(ObjectControl, RowObject, AttbName, _default) {
    if ($('#' + ObjectControl) != null) {
        if (RowObject.indexOf("_0") > 0) {
            $('#' + ObjectControl).val(_default);
        }
        else {
            $('#' + ObjectControl).val($('#' + RowObject).attr(AttbName));
        }
    }
}

function SetRecordCK(ObjectControl, RowObject, AttbName, _default) {
    if ($('#' + ObjectControl) != null) {
        var text = (RowObject.indexOf("_0") > 0) ? _default : $('#' + RowObject).attr(AttbName);
        CKEDITOR.instances[ObjectControl].setData(text);
    }

}

function SetRecordCheckBox(ObjectControl, RowObject, AttbName, _default) {
    if ($('#' + ObjectControl) != null) {
        if (RowObject.indexOf("_0") > 0) {
            if (_default == "True") {
                //$('#' + ObjectControl).attr('checked', 'checked');
                $('#' + ObjectControl).prop('checked', true);
            }
            else {
                //$('#' + ObjectControl).removeAttr('checked');
                $('#' + ObjectControl).prop('checked', false);
            }
        }
        else {
            if ($('#' + RowObject).attr(AttbName) == 1) {
                //$('#' + ObjectControl).attr('checked', 'checked');
                $('#' + ObjectControl).prop('checked', true);
            }
            else {
                $('#' + ObjectControl).prop('checked', false);
                //$('#' + ObjectControl).removeAttr('checked');
            }
        }
    }
}

function SetRecordRadio(ObjectControl, RowObject, AttbName, value_default, _default) {
    if ($("input[name='"+ObjectControl+"']") != null) {
        if (RowObject.indexOf("_0") > 0)   // Row 0 -> create new
        {
            if (_default == value_default) {
                $('#' + ObjectControl).prop('checked', true);
            }
            else {
                $('#' + ObjectControl).prop('checked', false);
            }
        }
        else {
            $("input[name='"+ObjectControl+"'][value='"+$('#'+RowObject).attr(AttbName)+"']").prop('checked', true);
            //if ($('#' + RowObject).attr(AttbName) == value_default) {
            //    $('#' + ObjectControl).prop('checked', true);
            //}
            //else {
            //    $('#' + ObjectControl).prop('checked', false);
           // }
        }
    }

}

function SetRecordComboBox(ObjectControl, RowObject, AttbName, _default) {  //mainForm.cboFunction.value=what.parent_id;
    if ($('#' + ObjectControl) != null) {
        if (RowObject.indexOf("_0") > 0) {
            $('#' + ObjectControl).val(_default);
        }
        else {
            $('#' + ObjectControl).val($('#' + RowObject).attr(AttbName));
        }
    }

}

/*//////////////////////////////*/
/*//////////////////////////////*/
/*//////////////////////////////*/


$(document).ready(function () {
    
    if($('#myBody').hasClass('modal-open'))
    {
        $(document).click(function () {
            $('.text-success').hide();
            var urlPath = removeURLParameter('Message');
            window.history.pushState("", "", urlPath);
            urlPath = removeURLParameter('AlertContent');
            window.history.pushState("", "", urlPath);
        });
    }
});

function ResetForm()
{
    clearValidation('#MainForm');
    $('.text-success').hide();
    var urlPath = removeURLParameter('Message');
    window.history.pushState("", "", urlPath);
}

function Download(field, controllername) {
    var _id = $('#' + field).val();
    if (_id == '0')
        alert('Vui lòng chọn một phần tử trong danh sách');
    else {
        document.location.href = '/Admintool/' + controllername + '/Download/' + _id;
    }

}

function Check_all(field) {
    var check_all = $(field).prop("checked");

    $('#tblListFunction input[type=checkbox]').each(function () {
        $(this).prop("checked", check_all);
    });
}

function DeleteAll() {
    var _listChecked = '';
    $('#tblListFunction input[type=checkbox]').each(function () {
        if ($(this).prop("checked") && $(this).val() != "all") {
            _listChecked += $(this).val() + '-';
        }
    });
    if (_listChecked == '') {
        event.preventDefault();
        alert('Vui lòng chọn một phần tử trong danh sách')
        return false;
    }
    else {
        $('#listId').val(_listChecked);
    }
}
$(document).ready(function() {
    $('#flash_mesage').delay(2500).slideUp();
});
$.fn.modal.Constructor.prototype.enforceFocus = function() {
  modal_this = this
  $(document).on('focusin.modal', function (e) {
    if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length 
    && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') 
    && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')
    && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_textarea')) {
      modal_this.$element.focus()
    }
  })
};    