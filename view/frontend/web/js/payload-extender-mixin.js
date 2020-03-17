define([
    'jquery',
    'mage/utils/wrapper'
], function ($, wrapper) {
    'use strict';

    return function (processor) {
        return wrapper.wrap(processor, function (proceed, payload) {
            payload = proceed(payload);
            console.log(payload);
            payload.addressInformation.extension_attributes.experience_survey_option = jQuery('[name="experience_survey_option"]').val();
            return payload;
        });
    };
});