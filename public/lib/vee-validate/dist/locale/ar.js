!function(n,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):(n.__locale__ar=n.__locale__ar||{},n.__locale__ar.js=e())}(this,function(){"use strict";var n={_default:function(n){return"قيمة الحقل "+n+" غير صحيحة."},after:function(n,e){return n+" يجب ان يكون بعد "+e[0]+"."},alpha_dash:function(n){return n+" قد يحتوي على حروف او الرموز - و _."},alpha_num:function(n){return n+" قد يحتوي فقط على حروف وارقام."},alpha_spaces:function(n){return n+" قد يحتوي فقط على حروف ومسافات."},alpha:function(n){return n+" يجب ان يحتوي على حروف فقط."},before:function(n,e){return n+" يجب ان يكون قبل "+e[0]+"."},between:function(n,e){return"قيمة "+n+" يجب ان تكون ما بين "+e[0]+" و "+e[1]+"."},confirmed:function(n){return n+" لا يماثل التأكيد."},credit_card:function(n){return"الحقل "+n+" غير صحيح."},date_between:function(n,e){return n+" يجب ان يكون ما بين "+e[0]+" و "+e[1]+"."},date_format:function(n,e){return n+" يجب ان يكون على هيئة "+e[0]+"."},decimal:function(n,e){void 0===e&&(e=["*"]);var t=e[0];return n+" يجب ان يكون قيمة رقمية وقد يحتوي على "+("*"===t?"":t)+" ارقام عشرية."},digits:function(n,e){return n+" يجب ان تحتوي فقط على ارقام والا يزيد عددها عن "+e[0]+" رقم."},dimensions:function(n,e){return n+" يجب ان تكون بمقاس "+e[0]+" بكسل في "+e[1]+" بكسل."},email:function(n){return n+" يجب ان يكون بريدا اليكتروني صحيح."},ext:function(n){return"نوع ملف "+n+" غير صحيح."},image:function(n){return n+" يجب ان تكون صورة."},in:function(n){return"الحقل "+n+" يجب ان يكون قيمة صحيحة."},ip:function(n){return n+" يجب ان يكون ip صحيح."},max:function(n,e){return"الحقل "+n+" يجب ان يحتوي على "+e[0]+" حروف على الأكثر."},max_value:function(n,e){return"قيمة الحقل "+n+" يجب ان تكون اصغر من "+e[0]+" او تساويها."},mimes:function(n){return"نوع ملف "+n+" غير صحيح."},min:function(n,e){return"الحقل "+n+" يجب ان يحتوي على "+e[0]+" حروف على الأقل."},min_value:function(n,e){return"قيمة الحقل "+n+" يجب ان تكون اكبر من "+e[0]+" او تساويها."},not_in:function(n){return"الحقل "+n+" غير صحيح."},numeric:function(n){return n+" يمكن ان يحتوي فقط على ارقام."},regex:function(n){return"الحقل "+n+" غير صحيح."},required:function(n){return n+" مطلوب."},size:function(n,e){return n+" يجب ان يكون اقل من "+e[0]+" كيلوبايت."},url:function(n){return"الحقل "+n+" يجب ان يكون رابطاً صحيحاً."}},e={name:"ar",messages:n,attributes:{}};return"undefined"!=typeof VeeValidate&&VeeValidate&&(VeeValidate.Validator,!0)&&VeeValidate.Validator.addLocale(e),e});