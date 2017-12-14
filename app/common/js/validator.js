$(document).ready(function() {
    $("form").bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '用户名不能为空'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z][a-zA-Z0-9_]{2,5}$/,
                        message: '用户名必须以字母开头,长度3到6位，只能包含字符、数字和下划线'
                    }
                }
            },
            password: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '密码不能为空'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]\w{4,17}$/,
                        message: '密码必须以字母开头,长度5到18位，只能包含字符、数字和下划线'
                    }
                }
            },
            confirmPassword: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '确认密码不能为空'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]\w{4,17}$/,
                        message: '密码必须以字母开头,长度5到18位，只能包含字符、数字和下划线'
                    },
                    identical: {//相同
                        field: 'password',
                        message: '两次密码不一致'
                    }
                }

            },
            vCode:{
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '验证码不能为空！'
                    },
                    regexp: {
                        regexp: /[a-zA-Z0-9]{4}/,
                        message: '验证码长度为4位'
                    }
                }
            },

            oldPassword: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '旧密码不能为空'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]\w{4,17}$/,
                        message: '旧密码必须以字母开头,长度5到18位，只能包含字符、数字和下划线'
                    }
                }
            },

            newPassword: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '新密码不能为空'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]\w{4,17}$/,
                        message: '新密码必须以字母开头,长度5到18位，只能包含字符、数字和下划线'
                    }
                }
            },

           againPassword: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '密码不能为空'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]\w{4,17}$/,
                        message: '密码必须以字母开头,长度5到18位，只能包含字符、数字和下划线'
                    },
                    identical: {//相同
                        field: 'newPassword',
                        message: '两次密码不一致'
                    }
                }
            },

        }
    });
});