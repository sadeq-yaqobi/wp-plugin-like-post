jQuery(document).ready(function ($) {

    fixed_display_type_show();
    offset_label();
    choose_pixel_percent('#x_pixel', '#x_percent', '#x_offset','.x-unit');
    choose_pixel_percent('#y_pixel', '#y_percent', '#y_offset','.y-unit');

    function fixed_display_type_show() {
        let positionType = $('select#position_type');
        let optionFixed = $('option.fixed');
        let optionStatic = $('option.static');
        let fixedPositionWrapper = $('div.fixed-position-option');

        if (optionFixed.is(':selected')) {
            fixedPositionWrapper.removeClass('d-none');
        }
        positionType.on('change', function () {
            if (optionFixed.is(':selected')) {
                fixedPositionWrapper.slideDown('slow');
            }
            if (optionStatic.is(':selected')) {
                fixedPositionWrapper.slideUp('slow');
            }
        });
    }


show_changing_range_input();

function show_changing_range_input() {

    let borderRadiusInput = $('#border_radius');
    let borderRadiusOutput = $('.lbs-border-radius-output');

    borderRadiusOutput.text(borderRadiusInput.val() + 'px');
    borderRadiusInput.on('input', function () {
        borderRadiusOutput.val(this.value + 'px');
    });

    let xOffsetOutput = $('.lbs-x-offset-output');
    let xOffsetInput = $('#x_offset');

    xOffsetOutput.text(xOffsetInput.val() );
    xOffsetInput.on('input', function () {
        xOffsetOutput.val(this.value );
    });

    let yOffsetOutput = $('.lbs-y-offset-output');
    let yOffsetInput = $('#y_offset');

    yOffsetOutput.text(yOffsetInput.val() );
    yOffsetInput.on('input', function () {
        yOffsetOutput.val(this.value );
    });

}

function offset_label() {
    let xLabel = $('#x_label');
    let rightOption = $('option.right');
    let leftOption = $('option.left');
    let yLabel = $('#y_label');
    let topOption = $('option.top');
    let bottomOption = $('option.bottom');
    let xPosition = $('#x_position');
    let yPosition = $('#y_position');

    if (rightOption.is(':selected')) {
        xLabel.text('فاصله از راست')
    }
    if (leftOption.is(':selected')) {
        xLabel.text('فاصله از چپ');
    }
    if (topOption.is(':selected')) {
        yLabel.text('فاصله از بالا')
    }
    if (bottomOption.is(':selected')) {
        yLabel.text('فاصله از پایین');
    }
    xPosition.on('change', function () {
        if (rightOption.is(':selected')) {
            xLabel.text('فاصله از راست')
        }
        if (leftOption.is(':selected')) {
            xLabel.text('فاصله از چپ');
        }
    });
    yPosition.on('change', function () {
        if (topOption.is(':selected')) {
            yLabel.text('فاصله از بالا')
        }
        if (bottomOption.is(':selected')) {
            yLabel.text('فاصله از پایین');
        }
    });
}

function change_range_input_attr(pixelInput, percentInput, offsetInput,unitOutput) {

    if ($(pixelInput).is(':checked')) {
        $(offsetInput).attr('min', '-1000').attr('max', '1000');
        $(unitOutput).text('px')
    }
    if ($(percentInput).is(':checked')) {
        $(offsetInput).attr('min', '0').attr('max', '100');
        $(unitOutput).text('٪')
    }
}

function choose_pixel_percent(pixelInput, percentInput, offsetInput,offsetOutput) {
    let pixel = $(pixelInput);
    let percent = $(percentInput);
    let offset = $(offsetInput);
    let output = $(offsetOutput);
    change_range_input_attr(pixel, percent, offset,output);

    pixel.on('input', function () {
        change_range_input_attr(pixel, percent, offset,output);
    })
    percent.on('input', function () {
        change_range_input_attr(pixel, percent, offset,output);
    })
}


})
;