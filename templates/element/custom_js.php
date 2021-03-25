<script>
    <?php if (empty($currentUser)) : ?>
        var loggedIn = false;
    <?php else : ?>
        var loggedIn = true;
        // $(this).unbind('submit').submit();
    <?php endif; ?>
    var isBizForm = false;
    var iscitySubForm = false;
    var isSaveCollection = false;
    var addPhotos = false;
    var addReview = false;
    var addReviewYes = false;
    var addReviewNo = false;
    var reportReview = false;
    var reportOwnerReply = false;
    var reportButton;
    var photoReport = false;
    var photoReportButton;
    var helpful_review_el;
    var helpful_review_action;
    var helpfulReview = false;
    var currentUser;

    var questionForm;
    var postQuestion = false
    var postquestion_resultmodal;


    var helpful_answer_el;
    var helpful_answer_action;
    var helpfulQuestion = false;

    var claimBusiness = false;
    var reportQuestion = false;
    var reportQuestionButton;

    var answerForm;
    var submitAnswer = false;


    var reportAnswer = false;
    var reportAnswerEl;


    var succss_modal;
    var ans_succss_modal;

    var unfollowBtn;
    var unfollowUser = false;

    var followBtn;
    var followUser = false;

    var blockresultmodal;
    var unblockresultmodal;

    var reportprofilesuccessmodal;
    var sendmessageModal;
    var messagesuccessmodal;

    var profileReport = false;
    var profileReportForm;

    var sendMessage = false;
    var sendMessageButton;



    var reportProfileModal;
    var reportProfileButton;
    var reportProfile = false;


    var pathname = window.location.pathname; // Returns path only (/path/example.html)
    var url = window.location.href; // Returns full URL (https://example.com/path/example.html)
    var origin = window.location.origin;
    //alert(url+"/User_authentication/chk_login");
    var redirectUrl = "<?= $redirectUrl ?>";
    // console.log(redirectUrl);
    var current_page = 1;
    var q_current_page = 1;
    var a_current_page = 1;
    var review_counts = 0;
    var question_counts = 0;
    var advice_counts = 0;
    var question_page = 1;
    var single_question_page = 1;
    var question_order = "Most_Recent";
    var business_id = "";
    var review_filter = {};
    var reviewToShareId = null;

    function getPhotoDeleteUrl() {
        return "<?= $this->Url->build(["prefix" => "Admin", 'controller' => "businesses", 'action' => 'deletePhoto']); ?>";
    }

    function getAllPhotosUrl() {
        return "<?= $this->Url->build(['controller' => "businesses", 'action' => 'gallery', (!empty($business) ? \Cake\Utility\Text::slug(strtolower($business->name)) : ''), (!empty($business->city) ? $business->city->state->code : ''), (!empty($business) ? $business->id : '')]); ?>";
    }

    function openReportReview(el) {
        var review_id = el.data('review_id');
        var business_id = el.data('business_id');
        // console.log(business_id);
        // console.log(review_id);
        $('#reportreviewform input[name=review_id]').val(review_id);
        $('#reportreviewform input[name=business_id]').val(business_id);

        new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#reportreviewModal'
            }
        }).open()
    }

    function openCancelSubscriptionModal(el) {
        var package = el.data('package');
        // var package_id = el.data('package_id');
        // var business_id = el.data('business_id');
        var subscription_id = el.data('subscription_id');
        $('#subscription_name').html(package);
        $('#cancelSubscriptionform input[name=subscription_id]').val(subscription_id);

        new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#cancel_subscription_modal'
            }
        }).open()

    }

    function openBusinessOwnerReplyReport(el) {
        var review_id = el.data('review_id');
        var business_id = el.data('business_id');
        // console.log(business_id);
        $('#reportownerform input[name=review_id]').val(review_id);
        $('#reportownerform input[name=business_id]').val(business_id);

        new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#reportownerModal'
            }
        }).open()

    }

    function block(target) {
        if (target) {
            App.blockUI({
                animate: true,
                target: target,
                overlayColor: 'none',
            });
        } else {
            App.blockUI({
                animate: true,
                overlayColor: 'none',
            });
        }
    }

    function printdiv(div) {
        var headstr = "<html><head><title></title></head><body>";
        var footstr = "</body>";
        var newstr = document.all.item(div).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr + newstr + footstr;
        window.print();
        document.body.innerHTML = oldstr;
        return false;
    }

    function checkNextAction() {
        loggedIn = true;
        if (isBizForm) {
            $('#biz_form').unbind('submit').submit();
        } else if (iscitySubForm) {
            // $('#citySubForm').unbind('submit').submit();
            // redirectToCheckout();
            calculateCityPrices(true);
        } else if (isSaveCollection) {
            getCollections();
        } else if (addPhotos) {
            addPhotosPage();
        } else if (reportReview) {
            openReportReview(reportButton);
        } else if (reportOwnerReply) {
            openBusinessOwnerReplyReport(reportButton);
        } else if (photoReport) {
            openPhotoReport(photoReportButton);
        } else if (postQuestion) {
            postQuestionForm();
        } else if (helpfulReview) {
            helpfulReviewAction()
        } else if (helpfulQuestion) {
            helpfulAnswerAction()
        } else if (reportAnswer) {
            openReportAnswer(reportAnswerEl);
        } else if (reportQuestion) {
            openReportQuestion(reportQuestionButton);
        } else if (submitAnswer) {
            submitAnswerAction();
        } else if (followUser) {
            followUserAction();
        } else if (unfollowUser) {
            unfollowUserAction();
        } else if (profileReport) {
            profileReportAction();
        } else if (sendMessage) {
            openSendMessageModal();
        } else if (claimBusiness) {
            openClaimModal();
        } else if (reportProfile) {
            openReportProfileModal();
        } else if (addReviewYes) {
            //addReviews();
            addReviewConfirm('yes');
            // $('#review_form').unbind('submit').submit();
        } else if (addReviewNo) {
            //addReviews();
            addReviewConfirm('no');
            // $('#review_form').unbind('submit').submit();
        }
    }

    function saveShare(data) {
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'saveShare']); ?>",
            data: data,
            success: function(data) {
                unblock();
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });
    }

    function addReviewConfirm(answer) {
        if(answer == 'yes')
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "GET",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id, '?' => ['recommend' => 'yes']]); ?>",
            data: {},
            success: function(data) {
                window.location.href = "<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id, '?' => ['recommend' => 'yes']]); ?>"
            },
            error: function(error) {
                console.log(error);
            }
        });
        else
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "GET",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id, '?' => ['recommend' => 'no']]); ?>",
            data: {},
            success: function(data) {
                window.location.href = "<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addReview', \Cake\Utility\Text::slug(strtolower($business->name)), strtolower($business->city->name), $business->city->state->code, $business->id, '?' => ['recommend' => 'no']]); ?>"
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function profileReportAction() {
        var data = profileReportForm.serialize();
        block();
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'reportProfile']); ?>",
            data: data,
            success: function(data) {
                unblock();
                Custombox.modal.close();
                reportprofilesuccessmodal.open();
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });
    }

    function currentSlide(slide, index) {
        // console.log("test");
        $('#slide' + slide + ' .review-image-gallery-item').css('display', 'none');
        $('#slide' + slide + ' .slideitem' + index).css('display', 'block');
        $('#sliderdot' + slide + ' .dot').removeClass('active');
        $('#sliderdot' + slide + ' .dotitem' + index).addClass('active');

    }

    function unfollowUserAction() {
        var targetuser_id = unfollowBtn.data('targetuser_id');
        var targetblock = unfollowBtn.data('block');
        // block();
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'unfollowUser']); ?>",
            data: {
                'user_id': targetuser_id,
                'random_id_target': targetblock
            },
            success: function(data) {
                unblock();
                $("#" + targetblock).html(data);
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });
    }


    function followUserAction() {
        var targetuser_id = followBtn.data('targetuser_id');
        var targetblock = followBtn.data('block');
        // console.log(targetblock);
        // block();
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'followUser']); ?>",
            data: {
                'user_id': targetuser_id,
                'random_id_target': targetblock
            },
            success: function(data) {
                unblock();
                $("#" + targetblock).html(data);
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });
    }


    function submitAnswerAction() {
        var question_id = answerForm.find('input[name=question_id]').val();
        var data = answerForm.serialize();
        block();
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'submitAnswer']); ?>",
            data: data,
            success: function(data) {
                unblock();

                // window.location.href = "<?= $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]); ?>";
                console.log(data);
                $('textarea[name="answer"]').val("");
                var target = answerForm.data('response_target');
                $("#" + target).html(data);
                // var old_top_answer = $("#top_answer_" + question_id).html();
                // $("#top_answer_" + question_id).html(data);
                // var collapse_answer = $("#showallanswer" + question_id).html();
                // if (old_top_answer) {
                //     if (collapse_answer == "") {
                //         $("#showallanswer" + question_id).prepend(old_top_answer);
                //         $('#showallbutton' + question_id).css('display', 'block');
                //     } else {
                //         $("#showallanswer" + question_id).prepend(old_top_answer);
                //     }
                //     $("#showallanswer" + question_id).collapse('hide');
                // }
                ans_succss_modal.open();
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });
    }

    function helpfulAnswerAction() {
        var answer_id = helpful_answer_el.data('aid');


        block();
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'helpfulAnswer']); ?>",
            data: {
                answer_id: answer_id,
                give: helpful_answer_action
            },
            success: function(data) {
                $('textarea[name="answer"]').val("");

                // $(this).find('textarea[name="product_question"]').text();
                unblock();

                if (data.success) {
                    if (helpful_answer_action) { //give

                        var helpfultarget = helpful_answer_el.data('helpfultarget');

                        // console.log(helpfultarget);

                        helpful_answer_el.addClass("text-primary");
                        helpful_answer_el.removeClass('give_helpful_answer');
                        helpful_answer_el.addClass('gave_helpful_answer');
                        helpful_answer_el.parents('ul').find('.give_unhelpful').removeClass("give_unhelpful_answer");
                        helpful_answer_el.find('span.show_helpful').text(data.count);
                        if (data.count > 1) {
                            $('#' + helpfultarget).text(data.count + " people found this helpful");
                        } else {
                            $('#' + helpfultarget).text(data.count + " person found this helpful");
                        }

                    } else {

                        var unhelpfultarget = helpful_answer_el.data('unhelpfultarget');

                        helpful_answer_el.addClass("text-primary");
                        helpful_answer_el.removeClass('give_unhelpful_answer');
                        helpful_answer_el.addClass('gave_unhelpful_answer');
                        helpful_answer_el.parents('ul').find('.give_unhelpful').removeClass("give_helpful_answer");
                        helpful_answer_el.find('span.show_unhelpful').text(data.count);

                        if (data.count > 1) {
                            $('#' + unhelpfultarget).text(data.count + " people found this unhelpful");
                        } else {
                            $('#' + unhelpfultarget).text(data.count + " person found this unhelpful");
                        }
                    }
                }
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });
    }

    function openSendMessageModal() {

        var receievername = sendMessageButton.data('receievername');
        var receieverid = sendMessageButton.data('receieverid');

        $('#sendmessageModal input[name=receiver_id]').val(receieverid);
        $('.messagereceiver').html(receievername);

        sendmessageModal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#sendmessageModal'
                // target: '#reportownerModal'
            }
        });
        sendmessageModal.open();


    }

    function openReportProfileModal() {

        var receievername = reportProfileButton.data('receievername');
        var receieverid = reportProfileButton.data('receieverid');

        $('#reportprofile input[name=profile_id]').val(receieverid);
        // $('.messagereceiver').html(receievername);

        reportProfileModal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#reportprofileModal'
                // target: '#reportownerModal'
            }
        });
        reportProfileModal.open();
    }

    function openReportQuestion(el) {

        var question_id = el.data('question_id');
        $('#reportquestionform input[name=question_id]').val(question_id);

        new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#reportquestionModal'
            }
        }).open()

    }

    function openReportAnswer(el) {
        var answer_id = el.data('answer_id');
        $('#reportanswerform input[name=answer_id]').val(answer_id);

        new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#reportanswerModal'
            }
        }).open()
    }


    function helpfulReviewAction() {
        var review_id = helpful_review_el.data('review_id');
        block();
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'helpfulReview']); ?>",
            data: {
                review_id: review_id,
                give: helpful_review_action
            },
            success: function(data) {
                // console.log(data);
                unblock();
                if (data.success) {
                    if (data.count == 1) {
                        var count_text = "1 person found this helpful.";
                    } else {
                        var count_text = data.count + " people found this helpful.";
                    }
                    $('#helpfulcount' + review_id).text(count_text);

                    if (helpful_review_action) { //give
                        helpful_review_el.removeClass("text-dark");
                        helpful_review_el.addClass("text-primary");
                        helpful_review_el.removeClass('give_helpful_review');
                        helpful_review_el.addClass('ungive_helpful_review');
                    } else {
                        helpful_review_el.addClass("text-dark");
                        helpful_review_el.removeClass("text-primary");
                        helpful_review_el.addClass('give_helpful_review');
                        helpful_review_el.removeClass('ungive_helpful_review');
                    }
                }
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });
    }

    function openPhotoReport(el) {
        var photo_id = el.data('photo_id');
        var is_review_photo = el.data('is_review_photo');
        // var business_id = $(this).data('business_id');
        // console.log(business_id);
        $('#reportphotoModal input[name=photo_id]').val(photo_id);
        $('#reportphotoModal input[name=is_review_photo]').val(is_review_photo);

        new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#reportphotoModal'
            }
        }).open()
    }


    function getCurrentUser() {
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getCurrentUser']); ?>",
            success: function(response) {
                if (response.success) {
                    currentUser = response.user;
                    $('input[id=claimPhone]').val(currentUser.phone);
                }
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });
    }

    function openClaimModal() {

        new Custombox.modal({
            content: {
                effect: 'fadein',
                // target: '#claimBusinessModal'
                target: '#claimBusinessModal2'
            }
        }).open();

        setTimeout(function() {
            // $('.checkbox').prop('required', true);
        }, 1000);

        getCurrentUser();

    }


    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    function updateQueryString(key, value, url) {
        if (!url) url = window.location.href;
        var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
            hash;

        if (re.test(url)) {
            if (typeof value !== 'undefined' && value !== null)
                return url.replace(re, '$1' + key + "=" + value + '$2$3');
            else {
                hash = url.split('#');
                url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];
                return url;
            }
        } else {
            if (typeof value !== 'undefined' && value !== null) {
                var separator = url.indexOf('?') !== -1 ? '&' : '?';
                hash = url.split('#');
                url = hash[0] + separator + key + '=' + value;
                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];
                return url;
            } else
                return url;
        }
    }


    function unblock(target) {
        if (target) {
            App.unblockUI(target);
        }
        App.unblockUI();
    }

    function getCollections(business_id = "<?= !empty($business) ? $business->id : '' ?>") {

        block();

        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getCollections']); ?>",
            data: {
                business_id: business_id
            },
            success: function(data) {
                unblock();
                $("#business_save_list").html(data);
                new Custombox.modal({
                    content: {
                        effect: 'fadein',
                        target: '#bookmarkModal'
                    }
                }).open()
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });

    }


    function getQuestions(el = null) {

        var ajaxUrl = "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getQuestions']); ?>";

        if (el) {
            var hrefUrl = el.attr('href');
            var page = getParameterByName('page', hrefUrl);
            ajaxUrl = updateQueryString('page', page, ajaxUrl);
        }

        ajaxUrl = updateQueryString('business_id', "<?= !empty($business) ? $business->id : '' ?>", ajaxUrl);

        block($('#qa_for_business'));

        var scroll_top = $('#pills-two-tab');
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "GET",
            url: ajaxUrl,
        }).done(function(data) {
            unblock();
            $('#qa_for_business').html(data);
            $("html, body").animate({
                scrollTop: $('#qa_for_business').offset().top
            }, "slow");
            //*** start pagination ***//
            $.SRCore.components.SRUnfold.init($('#qa_for_business [data-unfold-target]'));

        }).fail(function(response) {
            unblock();
        });


    }

    function addPhotosPage() {
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'uploadPhotos']); ?>",
            data: {
            },
            cache: false,
            success: function(response) {
                unblock();
                window.location.href = "<?= $this->Url->build(['prefix' => false, 'controller' => 'businesses', 'action' => 'addPhotos', $business->id, \Cake\Utility\Text::slug(strtolower($business->name))]); ?>"
                
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });
    }

    function load_tips(page, top_move) {
        var $scrollTo = $('#pills-three-tab');
        $.ajax({
            type: "POST",
            url: base_url + "v/get_tips_for_business",
            data: {
                page: page,
                business_id: business_id,
            },
            success: function(data) {
                // console.log(data);
                if (top_move)
                    var scroll_top = $scrollTo.offset().top;

                $('#tips_for_business').html(data);
                $("html, body").animate({
                    scrollTop: scroll_top
                }, "slow");
                //*** start pagination ***//
                $.SRCore.components.SRUnfold.init($('#tips_for_business [data-unfold-target]'));
                // return true;

            },
            error: function(error) {
                console.log(error);
            }
        })
    }


    function postQuestionForm() {

        if (!questionForm.valid()) return false;
        var data = questionForm.serialize();

        block();

        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'postQuestion']); ?>",
            data: data,
            success: function(response) {
                // console.log(data);
                unblock();
                if (response.success) {
                    // window.location.href = "<?= $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]); ?>";
                    window.location.href = response.url;

                    // $('#postquestionform textarea').val("");
                    // getQuestions();
                    // postquestion_resultmodal.open();
                    // $('#collapseExample').collapse('toggle');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(error) {
                console.log(error);
                unblock();
            }
        });
    }

    function getBusinessReviews(review_block, el, tips = false) {
        block(review_block);
        var hrefUrl = el.attr('href');
        var page = getParameterByName('page', hrefUrl);

        var ajaxUrl = "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getBusinessReviews']); ?>";
        ajaxUrl = updateQueryString('page', page, ajaxUrl);
        ajaxUrl = updateQueryString('tips', tips, ajaxUrl);
        ajaxUrl = updateQueryString('business_id', "<?= !empty($business) ? $business->id : '' ?>", ajaxUrl);
        ajaxUrl = updateQueryString('filters', review_filter.join('-'), ajaxUrl);

        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "GET",
            url: ajaxUrl,
        }).done(function(data) {
            unblock();
            review_block.html(data);
            $('html, body').animate({
                scrollTop: review_block.offset().top
            }, "slow");
            review_block.hide().fadeIn("slow");
            $.SRCore.components.SRUnfold.init($('#reviews_for_business [data-unfold-target]'));
        }).fail(function(response) {
            unblock();
        });
    }



    function dataload_for_page() { //TODO
        console.log("<?= $_SERVER['REQUEST_URI'] ?>");
        var url = "<?= $_SERVER['REQUEST_URI'] ?>";
        if (url.includes("user_details_reviews") || url.includes("user_details")) {
            var login_id = $('input[id=sessionid]').val();
        }
    }

    function getLocation() {
        var location = <?php echo json_encode($currentLocation); ?>;
        if (typeof location != null && location['region'] != "" && location['city'] != "") {
            var result = location['city'] + ', ' + location['region'];
            $('#suggested-location').val(result);
            // 		var loc = $('#suggested-location').val();
            // 		loc = loc.trim();
            // 		loc = loc.replace(/ /g, "-");
            //         loc = loc.replace(/,/g, "");
            //         $('input[name=loc]').val(loc);
        }

        // console.log(location);
    }

    function ToastMessage(text, status, duration) {
        setTimeout(function() {
            // create the notification
            var notification = new NotificationFx({
                message: text,
                layout: 'growl',
                effect: 'jelly',
                type: status, // notice, warning, error or success
                ttl: duration,
                onClose: function() {

                }
            });
            // show the notification
            notification.show();

        }, 1000);


    }

    function getCitiesList(keyword = "") {
        if (!keyword || keyword.length < 2) {
            return false;
        }
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getCitiesList']); ?>",
            data: {
                keyword: keyword,
            },
            success: function(data) {
                // console.log(data);
                $("#location_pretext").html(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    $(document).ready(function() {
        getCitiesList();



        reportprofilesuccessmodal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#reportprofilesuccessmodal'
            }
        });

        messagesuccessmodal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#messagesuccessmodal'
            }
        });
        succss_modal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#succesmodal'
            }
        });




        ans_succss_modal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#answersuccesmodal'
            }
        });



        postquestion_resultmodal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#postquestionresultmodal'
            }
        });


        // $('.reportquestion').click(function() {
        jQuery(document).on('click', '.reportquestion', function(e) {
            e.preventDefault();
            reportQuestionButton = $(this);
            if (loggedIn) {
                openReportQuestion($(this));
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                reportQuestion = true;
            }
        });


        jQuery(document).on('click', '.reportreview', function(e) {
            reportButton = $(this);
            if (loggedIn) {
                openReportReview($(this));
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                reportReview = true;
            }
        });


        jQuery(document).on('click', '.reportownerModal', function(e) {
            reportButton = $(this);

            if (loggedIn) {
                openBusinessOwnerReplyReport($(this));
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                reportOwnerReply = true;
            }

        });

        jQuery(document).on('click', '.facebooksharebtn', function(e) {
            saveShare({
                business_id: $(this).data('businessid'),
                facebook: true
            });
        });

        jQuery(document).on('click', '.twittersharebtn', function(e) {
            saveShare({
                business_id: $(this).data('businessid'),
                twitter: true
            });
        });
        jQuery(document).on('click', '.sharereviewfb', function(e) {
            saveShare({
                business_review_id: reviewToShareId,
                facebook: true
            });
        });
        jQuery(document).on('click', '.sharereviewtwitter', function(e) {
            saveShare({
                business_review_id: reviewToShareId,
                twitter: true
            });
        });

        jQuery(document).on('click', '.sharereview', function(e) {

            var review_id = $(this).data('review_id');
            reviewToShareId = review_id;
            var business_id = $(this).data('business_id');
            var url = $(this).data('url');
            // console.log(url);
            $('#sharereviewModal input[name=review_id]').val(review_id);
            $('#sharereviewModal input[name=business_id]').val(business_id);
            $('#sharereviewModal input[id=referralLink]').val(url);
            $('#sharereviewModal .facebookshare').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + url);
            $('#sharereviewModal .twittershare').attr('href', 'https://twitter.com/share?url=' + url + '&text=Check out this review on @localinspirecom');

            new Custombox.modal({
                content: {
                    effect: 'fadein',
                    target: '#sharereviewModal'
                }
            }).open()

            // }

            // saveShare({business_review_id: review_id});
        });

        //not sure this is in use
        jQuery(document).on('click', '.likedreview', function(e) {

            var review_id = $(this).data('rw');
            var business_id = $(this).data('b');
            $('#likedModal input[name=review_id]').val(review_id);
            // $('#likedModal input[name=uid]').val(uid);
            $('#likedModal input[name=business_id]').val(business_id);

            new Custombox.modal({
                content: {
                    effect: 'fadein',
                    target: '#likedModal'
                }
            }).open()

            // }
        });

        jQuery(document).on('submit', '.reply_review_form', function(e) {
            e.preventDefault();
            var $this = $(this);
            var review_id = $('input[name=review_id]').val();
            if (!$(this).valid()) return false;
            var data = $(this).serialize();

            var parent = $(this).data('parent');
            var target = $(this).data('target');

            block();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'replyReview']); ?>",
                data: data,
                success: function(response) {
                    // console.log(data);
                    unblock();
                    $('#' + parent).fadeOut("slow", function() {
                        // Animation complete.
                        $('#' + target).html(response);

                        $('#' + target).hide().fadeIn("slow", function() {
                            // review_block.html(data);
                            $('html, body').animate({
                                scrollTop: $('#' + target).offset().top
                            }, "slow");
                        });
                    });
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });

        });

        jQuery(document).on('submit', '#cancelSubscriptionform', function(e) {
            e.preventDefault();
            var data = $(this).serialize();

            block();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'cancelSubscription']); ?>",
                data: data,
                success: function(response) {
                    // console.log(data);
                    unblock();
                    if (response.success) {
                        window.location.href = "<?= $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]); ?>";
                    } else {
                        toastr.error(response.message);
                    }

                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });

        });



        jQuery(document).on('click', '.give_helpful_review', function(e) {
            e.preventDefault();

            helpful_review_el = $(this);
            helpful_review_action = true;
            if (loggedIn) {
                helpfulReviewAction()
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                helpfulReview = true;
            }
        });


        jQuery(document).on('click', '.ungive_helpful_review', function(e) {
            e.preventDefault();
            helpful_review_el = $(this);
            helpful_review_action = false;
            if (loggedIn) {
                helpfulReviewAction()
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                helpfulReview = true;
            }
        });



        jQuery(document).on('click', '.give_helpful_answer', function(e) {
            // $('#qa_for_business').on('click', '.give_helpful', function() {
            helpful_answer_el = $(this);
            helpful_answer_action = true;
            if (loggedIn) {
                helpfulAnswerAction()
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                helpfulQuestion = true;
            }
        });


        jQuery(document).on('click', '.give_unhelpful_answer', function(e) {
            // $('#qa_for_business').on('click', '.give_unhelpful', function() {
            helpful_answer_el = $(this);
            helpful_answer_action = false;
            if (loggedIn) {
                helpfulAnswerAction()
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                helpfulQuestion = true;
            }
        });


        $('form.answer_form').submit(function(e) {
            e.preventDefault();
            if (!$(this).valid()) return false;
            answerForm = $(this);
            if (loggedIn) {
                submitAnswerAction()
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                submitAnswer = true;
            }
        });

        jQuery(document).on('click', '.reportanswer', function() {
            reportAnswerEl = $(this);
            if (loggedIn) {
                openReportAnswer(reportAnswerEl);
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                reportAnswer = true;
            }
        });


        $('#near_by_current_location').click(function() {
            getLocation();
            setTimeout(function() {
                location.reload();
            }, 2000);

        });

        $('#suggestion_contianer').on('click', '.item', function() {

            var content = $(this).text();
            var newStr = content.replace(/(^\s+|\s+$)/g, '');
            console.log(newStr);
            $('#suggested-searches').val(newStr);
            // 	$('input[name=id]').val($(this).data('item_id'));
            // 	$('input[name=type]').val($(this).data('type'));
            // 	$('input[name=find]').val(newStr.replace(/ /g, '-'));
            $('#suggestions').hide();

        });

        $('#location_contianer').on('click', '.item-loc', function() {

            var location_content = $(this).text();
            $('#suggested-location').val(location_content);
            // var newLoc = location_content.replace(/(^\s+|\s+$)/g, '');
            // console.log(newLoc);
            // $('input[name=loc]').val($(this).data('value'));
            // $('#suggested-location').val(newLoc);
            $('#location-suggest').hide();
        });

        $("#suggested-location").bind('keyup', function() {
            var keyword = $(this).val();
            // console.log(keyword);
            getCitiesList(keyword);
        })
        $("#suggested-location").on('focusin', function() {
            $(this).select();
        })
        $("#suggested-searches").on('focusin', function() {
            $(this).select();
        })
    });

    function capitalize(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }

    function messagelistener() {
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'messagelistener']); ?>",
            success: function(response) {
                $('#notifications_unread_messages').html(response);
            },
            error: function(error) {}
        });
    }

    function notificationslistener() {
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'notificationslistener']); ?>",
            success: function(response) {
                $('#notifications_unread').html(response);
            },
            error: function(error) {}
        });
    }

    function loadInitialList(keyword = "") {

        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            type: "POST",
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'searchKeywordList']); ?>",
            data: {
                keyword: keyword,
            },
            success: function(response) {
                //  console.log(data);
                if (response.success) {
                    var html = '<ul id="explore-by"><!--<li class="font-weight-bold text-body text-left mb-1 pl-4 mt-1">Suggested Searches</li>-->';
                    for (var i in response.result) {
                        html += '<li class="item" data-item_type="cat" data-item_id="' + response.result[i]['category_id'] + '" data-type="' + response.result[i]['type'] + '">';
                        html += '<div class="start-step-label">';
                        html += '<i class="fas fa-search"></i>&nbsp;&nbsp;';
                        html += '<span>' + response.result[i]['name'] + '</span>';
                        html += '</div></li>';
                    }
                    html += '</ul>';
                    $('.suggestion-items').html(html);
                } else {
                    var html = '<ul id="explore-by"><li class="font-weight-bold text-body text-left mb-1 pl-4 mt-1">No suggested search</li></ul>';
                    $('.suggestion-items').html(html);
                }
            },
            error: function(error) {
                console.log(error);
                var html = '<ul id="explore-by"><li class="font-weight-bold text-body text-left mb-1 pl-4 mt-1">No suggested search</li></ul>';
                $('.suggestion-items').html(html);
            }
        });
    }

    $(document).ready(function() {
        loadInitialList();
        // messagelistener();
        <?php if (getEnv('SERVER_NAME') != "inspire4.local") { ?>
            setInterval(function() {
                messagelistener();
                notificationslistener();
            }, 30000);
        <?php } else { ?>
            setInterval(function() {
                messagelistener();
                notificationslistener();
            }, 1800000);
        <?php } ?>

        $('input[id=suggested-searches]').bind('keyup', function() {
            var keyword = $(this).val();
            //  console.log(keyword);
            if (keyword) {
                loadInitialList(keyword);
            } else {
                loadInitialList();
            }

        });
        $('#search_form').submit(function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var search = $("input[id=suggested-searches]").val();
            var location = $("input[id=suggested-location]").val();
            url = updateQueryString('find', search, url);
            url = updateQueryString('location', location, url);
            window.location.href = url;
        });
    })


    function userLogin() {
        var username_or_email = $('#username_or_email').val();
        var password = $('#password').val();

        block();

        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'userLogin']); ?>",
            data: {
                username_or_email: username_or_email,
                password: password,
            },
            method: "post",
            dataType: "json",
            success: function(response) {
                unblock();
                console.log("Login success >> ", response);
                if (response.success) {
                    checkNextAction();

                    if (redirectUrl != "/") {
                        window.location.href = redirectUrl;
                    }
                    var eID = response.user.id;
                    Custombox.modal.close();
                    $("#showImg").attr("src", response.user.image);
                    $("#ShowName").text(response.user.firstname + ' ' + response.user.lastname);
                    $(".after_login_img").attr("src", response.user.image);
                    $(".after_login_name").text(response.user.firstname + ' ' + response.user.lastname);
                    $('#sessionid').val(eID);
                    $('.after_login').css({
                        'display': 'block'
                    });
                    $('.after_login_view_profile').css({
                        'display': 'block'
                    });
                    $('.before_login').css({
                        'display': 'none'
                    });
                    dataload_for_page();
                } else {
                    $("#error").html(response.message);
                }
            },
            error: function(error) {
                unblock();
                console.log("Login error >> ", error);
            }
        });
    }

    //create user ajax
    function registerUser(form) {

        block();
        var firstname = form.find(".firstname").first().val();
        var lastname = form.find(".lastname").first().val();
        var email = form.find(".email").first().val();
        var password = form.find(".password").first().val();
        var ref_id = form.find(".ref_id").first().val();
        var join_form = form.find(".join_form").first().val();
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'userRegister']); ?>",
            data: {
                firstname: firstname,
                lastname: lastname,
                email: email,
                password: password,
                ref_id: ref_id,
            },
            method: "post",
            dataType: "json",
            success: function(response) {
                unblock();
                console.log("signup >>> ", response)
                $('.Verifymail').css({
                    'display': 'block'
                });
                //   alert(data.insert[0]['Member_ID']);
                //alert(data.status);
                if (response.success) {

                    if (join_form == "1") {
                        window.location.href = "<?= $this->Url->build(['controller' => "Account", 'action' => 'settings']); ?>";
                        return;
                    }
                    // checkNextAction();
                    loggedIn = true;

                    var eID = response.user.id;
                    var img = response.user.image;
                    Custombox.modal.close();
                    document.getElementById('signup_username').innerHTML = "Welcome to localinspire, " + response.user.firstname + " " + response.user.lastname + "!";
                    $('#emailsignup').trigger("click");
                    //$('#emailsignupModal').modal("show");
                    $("#showImg").attr("src", img);
                    $(".after_login_img").attr("src", img);
                    $("#ShowName").text(response.user.firstname + ' ' + response.user.lastname);
                    $(".after_login_name").text(response.user.firstname + ' ' + response.user.lastname);



                    $('.after_login').css({
                        'display': 'block'
                    });
                    $('.after_login_view_profile').css({
                        'display': 'block'
                    });
                    $('.before_login').css({
                        'display': 'none'
                    });

                    $("#EmailGmail").val(eID);

                    setTimeout(function() {
                        // console.log("starting datepicker");

                        // https://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
                        $(".datepicker").datepicker({
                            // format: 'dd-mm-yyyy',
                            format: 'DD dd MM yyyy',
                            // format: 'yyyy/mm/dd',
                        });
                    }, 2000);
                    // $('.close').trigger( "click" );
                    dataload_for_page();
                } else {
                    $('#error-msg').show(response.message);
                }

                $('.lastid').val(eID);

                $('#FirstName').val();
                $('#LastName').val();
                $('#EmailUser').val();
                $('#signupPassword').val();

            },
            error: function(error) {
                unblock();
                console.log("signup >>> ", error);
            }
        });
        return false;
    }
    //create user ajax


    $(window).on('load', function() {
        $('.js-mega-menu').SRMegaMenu({
            event: 'hover',
            pageContainer: $('.container'),
            breakpoint: 767.98,
            hideTimeOut: 0
        });
        $('.js-breadcrumb-menu').SRMegaMenu({
            event: 'hover',
            pageContainer: $('.container'),
            breakpoint: 991.98,
            hideTimeOut: 0
        });

        // initialization of svg injector module
        $.SRCore.components.SRSVGIngector.init('.js-svg-injector');
    });

    $(document).on('ready', function() {

        // $('#emailsignup').trigger("click");
        // initialization of header
        $.SRCore.components.SRHeader.init($('#header'));

        // initialization of unfold component


        $.SRCore.components.SRUnfold.init($('[data-unfold-target]'), {
            afterOpen: function() {
                $(this).find('input[type="search"]').focus();
            }
        });


        // initialization of malihu scrollbar
        $.SRCore.components.SRMalihuScrollBar.init($('.js-scrollbar'));

        // initialization of forms
        $.SRCore.components.SRFocusState.init();

        // initialization of form validation
        $.SRCore.components.SRValidation.init('.js-validate');

        // initialization of autonomous popups
        $.SRCore.components.SRModalWindow.init('[data-modal-target]', '.js-modal-window', {
            autonomous: true
        });

        // initialization of step form
        $.SRCore.components.SRStepForm.init('.js-step-form');

        // initialization of show animations
        $.SRCore.components.SRShowAnimation.init('.js-animation-link');

        // initialization of range datepicker
        $.SRCore.components.SRRangeDatepicker.init('.js-range-datepicker');

        // initialization of chart pies
        var items = $.SRCore.components.SRChartPie.init('.js-pie');

        // initialization of fancybox
        $.SRCore.components.SRFancyBox.init('.js-fancybox');

        // initialization of forms
        // $.SRCore.components.SRRangeSlider.init('.js-range-slider', {
        //     onFinish: function(data) {
        //         console.log(data);
        //     }
        // });

        // initialization of slick carousel
        $.SRCore.components.SRSlickCarousel.init('.js-slick-carousel');

        // initialization of datatables
        // $.SRCore.components.SRDatatables.init('.js-datatable');

        // initialization of select picker
        $.SRCore.components.SRSelectPicker.init('.js-select');


        // initialization of horizontal progress bars
        var horizontalProgressBars = $.SRCore.components.SRProgressBar.init('.js-hr-progress', {
            direction: 'horizontal',
            indicatorSelector: '.js-hr-progress-bar'
        });

        var verticalProgressBars = $.SRCore.components.SRProgressBar.init('.js-vr-progress', {
            direction: 'vertical',
            indicatorSelector: '.js-vr-progress-bar'
        });

        // initialization of go to
        $.SRCore.components.SRGoTo.init('.js-go-to');

        // initialization of animation
        //$.SRCore.components.SROnScrollAnimation.init('[data-animation]');

        // initialization of scroll effect component
        $.SRCore.components.SRScrollEffect.init('.js-scroll-effect');
    });

    $(window).on('load', function() {

        $.SRCore.components.SRScrollNav.init($('.js-scroll-nav'), {
            duration: 700,
            customOffsetTop: 77
        });
        var offsetTop = $('#logoAndNav').outerHeight();
    });

    function SRSwitchTab(sr_tab_id, sr_tab_content) {
        // first of all we get all tab content blocks (I think the best way to get them by class names)
        var x = document.getElementsByClassName("tabcontent");
        var i;
        for (i = 0; i < x.length; i++) {
            x[i].style.display = 'none'; // hide all tab content
        }
        document.getElementById(sr_tab_content).style.display = 'block'; // display the content of the tab we need
        // now we get all tab menu items by class names (use the next code only if you need to highlight current tab)
        var x = document.getElementsByClassName("tabmenu");
        var i;
        for (i = 0; i < x.length; i++) {
            x[i].className = 'tabmenu';
        }
        document.getElementById(sr_tab_id).className = 'tabmenu active';
    }

    function showLogin() {
        $('#signup').css("display", "none");
        $('#login').css("display", "block");

    }

    function showSignup() {
        $('#login').css("display", "none");
        $('#signup').css("display", "block");

    }

    $(window).on('load', function() {
        //  $('#myModal').modal('show');
        $('#showError').hide();
    });

    function updateRegisterUser() {
        var GId = $('.is_customer_login').val();
        var Password = $('#PasswordGmail').val();
        if (Password == '') {
            $('#showError').show();
        } else {
            $.ajax({
                url: base_url + "User_authentication/updateUserByGmail",
                data: {
                    Password: Password,
                    GId: GId
                },
                method: "post",
                dataType: "json",
                success: function(data) {

                    $('#myModal').modal('hide');

                }
            });
        }
    }


    // Load the JavaScript SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    window.fbAsyncInit = function() {
        FB.init({
            appId: '363493931189519', // FB App ID
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true, // parse social plugins on this page
            version: 'v4.0', // use graph api version 2.8
            status: true
        });

        // 	if (response.status === 'connected') {
        // 		//display user data
        // 		getFbUserData();
        // 		getFbUserDatas();
        // 	}
        // auto_fbLogin();

    }

    // Facebook login with JavaScript SDK
    function fbLogin() {
        FB.login(function(response) {
            if (response.authResponse) {
                //  console.log(response);
                // Get and display the user profile data
                getFbUserData();
            } else {
                document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
            }
        }, {
            scope: 'email'
        });
    }

    function getFbUserData() {
        // 	if(typeof Custombox != null)Custombox.modal.close();
        Custombox.modal.close();
        FB.api('/me', {
                locale: 'en_US',
                fields: 'id,first_name,last_name,email,link,gender,locale,picture'
            },
            function(response) {
                var data = {
                    FirstName: response.first_name,
                    LastName: response.last_name,
                    Email: response.email,
                    Month: 'null',
                    Day: 'null',
                    Year: 'null',
                    Face_id: response.id,
                    Login_Way: 'fb',
                    image: response.picture.data.url
                }
                // console.log(data);
                $.ajax({
                    url: base_url + "User_authentication/fblogin",

                    data: {
                        FirstName: response.first_name,
                        LastName: response.last_name,
                        Email: response.email,
                        Month: 'null',
                        Day: 'null',
                        Year: 'null',
                        Face_id: response.id,
                        Login_Way: 'fb',
                        image: response.picture.data.url
                    },
                    method: "post",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        var eID = data.Member_ID;
                        var img = data.Profile;
                        // alert(data.Password);
                        // 	data = data[0];
                        $('.is_customer_login').val(data.Member_ID);

                        if (data.status === 'true') {
                            // checkNextAction();
                            loggedIn = true;
                            if (data.Password === '') {
                                $('#myModal').modal('show');
                            }
                            if (img != "") {
                                imgData = data.Profile;
                            } else {
                                imgData = base_url + "assets/images/noprofile.png";
                            }
                            $("#showImg").attr("src", imgData);
                            $(".after_login_img").attr("src", imgData);
                            $(".after_login_name").text(data.FirstName + ' ' + data.LastName);
                            $("#spanname").text(data.FirstName + ' ' + data.LastName);
                            $("#ShowName").text(data.FirstName + ' ' + data.LastName);
                            $('#sessionid').val(eID);


                            $('.after_login').css({
                                'display': 'block'
                            });
                            $('.after_login_view_profile').css({
                                'display': 'block'
                            });
                            $('.before_login').css({
                                'display': 'none'
                            });

                            $("#EmailGmail").val(eID);

                        }

                        if (data == 'Email Already Exists') {
                            $('#error-msg').show();
                        }

                        dataload_for_page();

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });
    }





    // Logout from facebook
    function fbLogout() {
        FB.logout(function() {
            document.getElementById('fbLink').setAttribute("onclick", "fbLogin()");
            document.getElementById('fbLink').innerHTML = '<img src="fblogin.png"/>';
            document.getElementById('userData').innerHTML = '';
            document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';
        });
    }

    function onLoadGoogleCallback() {
        gapi.load('auth2', function() {
                auth2 = gapi.auth2.init({
                    client_id: '220791968929-0t28vr2jeliutgtnmnbsgja2qt7iajq1.apps.googleusercontent.com',
                    cookiepolicy: 'single_host_origin',
                    scope: 'profile email'
                });

                auth2.attachClickHandler(element, {},
                    function(googleUser) {
                        //console.log(googleUser);
                        var name = googleUser.getBasicProfile().getName();
                        var str = name.split(" ");
                        var email = googleUser.getBasicProfile().getEmail();
                        var accesstoken = googleUser.getBasicProfile().getId();
                        var image = googleUser.getBasicProfile().getImageUrl();

                        $.ajax({
                            type: "POST",
                            url: base_url + "User_authentication/googlelogin",
                            data: {
                                givenName: str['0'],
                                givenLast: str['1'],
                                emails: email,
                                id: accesstoken,
                                image: image
                            },
                            crossDomain: true,
                            dataType: "json",
                            success: function(response) {
                                var eID = response.Member_ID;
                                if (response.status == "true") {
                                    if (response.Password === '') {
                                        $('#myModal').modal('show');
                                    }
                                    $("#showImg").attr("src", response.Profile);
                                    $("#spanname").text(response.FirstName);
                                    $("#ShowName").text(response.FirstName + ' ' + response.LastName);
                                    $(".after_login_img").attr("src", response.Profile);
                                    $(".after_login_name").text(response.FirstName + ' ' + response.LastName);
                                    $('#sessionid').val(eID);
                                    $('.after_login').css({
                                        'display': 'block'
                                    });
                                    $('.after_login_view_profile').css({
                                        'display': 'block'
                                    });
                                    $('.before_login').css({
                                        'display': 'none'
                                    });
                                    Custombox.modal.close();
                                    dataload_for_page();
                                } else {
                                    alert("error");
                                }
                            }
                        });
                    }
                );
            }),
            function(error) {
                console.log('Sign-in error', error);
            }
        element = document.getElementById('googlebuttonclick');
    }

    function updateUserData(data) {
        if (data) {
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'updateUserData']); ?>",
                cache: false,
                data: data,
                type: 'post',
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(response) {
                    toastr.error("Something went wrong", "Oops!");
                    // $('#msg').html(response); // display error response from the server
                }
            });
        }
    }

    function updateSocialOptions(data) {
        if (data) {
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'updateSocialOptions']); ?>",
                cache: false,
                data: data,
                type: 'post',
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);

                        if (response.create_password) {
                            $('.passchanged').show();
                            document.getElementById("mail").value = "";
                            document.getElementById("reenter").value = "";
                        }


                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(response) {
                    toastr.error("Something went wrong", "Oops!");
                    // $('#msg').html(response); // display error response from the server
                }
            });
        }
    }

    function updateNotificationOptions(data) {
        if (data) {
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'updateNotificationOptions']); ?>",
                cache: false,
                data: data,
                type: 'post',
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(response) {
                    toastr.error("Something went wrong", "Oops!");
                    // $('#msg').html(response); // display error response from the server
                }
            });
        }
    }


    function savegender() {
        $('#emailsignupModal').css('display', 'none');
        var gender = $("input[name='gender']:checked").val();
        // var dob = $("input[name='dob']").val();
        var dob = $('select[name^="dob[year]"]').val() + "-" + $('select[name^="dob[month]"]').val() + "-" + $('select[name^="dob[day]"]').val();

        console.log(gender)
        console.log(dob)
        updateUserData({
            gender: gender,
            dob: dob
        });

        $('.custombox-open').css('background-color', 'transparent');


    }


    $(document).mouseup(function(e) {
        var container = new Array();
        container.push($('#location-suggest'));
        container.push($('#suggestions'));

        $.each(container, function(key, value) {
            if (!$(value).is(e.target) // if the target of the click isn't the container...
                &&
                $(value).has(e.target).length === 0) // ... nor a descendant of the container
            {
                $(value).hide();
            }
        });
    });

    // $('.item').on('click', function () {

    // 	var content = $(this).text();
    // 	var newStr = content.replace(/(^\s+|\s+$)/g, '');

    // 	$('#suggested-searches').val(newStr);
    // });

    // $('.item-loc').on('click', function () {

    // 	var location_content = $(this).text();
    // 	var newLoc = location_content.replace(/(^\s+|\s+$)/g, '');

    // 	$('#suggested-location').val(newLoc);
    // });




    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Facebook login with JavaScript SDK
    function fbLoginpicture() {

        FB.login(function(response) {
            if (response.authResponse) {
                // Get and display the user profile data
                getFbUserDatas();
            } else {
                document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
            }
        }, {
            scope: 'email'
        });
    }

    // Fetch the user profile data from facebook
    function getFbUserDatas() {

        FB.api('/me', {
                locale: 'en_US',
                fields: 'id,first_name,last_name,email,link,gender,locale,picture'
            },
            function(response) {

                var imm = response.picture.data.url;
                $(".after_login_img").attr("src", imm);

                $(".imagechange").attr("src", imm);
                var mid = $('.is_customer_login').val();

                $.ajax({
                    url: base_url + "User_authentication/NormalFB",
                    data: {
                        mid: mid,
                        image: imm,
                        Email: response.email
                    },
                    method: "post",
                    dataType: "json",
                    success: function(data) {


                    }
                });

            });
    }




    ////ResendMail///


    function ResendMail() {

        var id = $('.is_customer_login').val();

        $.ajax({
            url: base_url + "User_authentication/ResensMail",
            data: {
                id: id
            },
            method: "post",
            dataType: "json",
            success: function(data) {
                $(".sentMail").show();
                $(".Verifymail").hide();
            }
        });
    }


    ////ResendMail///


    function RecoverPassword() {
        var email = $('#recoverSrEmail').val();


        $.ajax({
            url: base_url + "index.php/Forgot/RecoverPassword",
            data: {
                email: email
            },
            method: "post",
            dataType: "json",
            success: function(data) {
                //Custombox.modal.close();
                // $('.close').trigger('click');  
                if (data != "") {
                    $(".before").hide();
                    $('.resetmsg').html('You will receive a message at ' + email + ' if you have registered your account with that email address. Please check for an email from localinspire and click on the included link to reset your password.');
                    $('.resetmsg').css({
                        'background': '#daecd2',
                        'margin-top': '50px',
                        'padding': '12px'
                    });
                } else {
                    $(".before").hide();
                    $('.resetmsg').html('Your emailid not found in system.');
                    $('.resetmsg').css({
                        'color': 'red',
                        'margin-top': '50px',
                        'padding': '12px'
                    });
                }

            }
        });


    }

    function CreatePassword() {

        var mail = $('#mail').val();
        var password = $('#password').val();
        var reenter = $('#reenter').val();
        if (password == '') {
            $('.errpass').html('Password cannot be blank!');
            $('.errpass').css({
                'color': 'red'
            });

        } else if (password == reenter) {

            updateSocialOptions({
                password: password,
                message: "Password Updated",
                create_password: true
            });


        } else {

            $('.err').html('The password must be the same!');
            $('.err').css({
                'color': 'red'
            });

        }
    }
    var x = document.getElementById("currentlocation");

    function getLocation() {
        var location = <?php echo json_encode($currentLocation); ?>;
        if (typeof location != null && location['region'] != "" && location['city'] != "") {
            var result = location['city'] + ', ' + location['region'];
            $('#suggested-location').val(result);
            // 		var loc = $('#suggested-location').val();
            // 		loc = loc.trim();
            // 		loc = loc.replace(/ /g, "-");
            //         loc = loc.replace(/,/g, "");
            //         $('input[name=loc]').val(loc);
        }

        // console.log(location);
    }

    function showPosition(position) {
        // x.innerHTML = "Latitude: " + position.coords.latitude + 
        // "<br>Longitude: " + position.coords.longitude;
        var latlon = position.coords.latitude + "," + position.coords.longitude;
        console.log(position);
        $.ajax({
            url: "https://www.localinspire.com/base/current_location_address",
            type: "POST",
            data: {
                latlon: latlon
            },
            success: function(result) {
                console.log(result);
                $('#suggested-location').val(result);
                var loc = $('#suggested-location').val();
                loc = loc.trim();
                loc = loc.replace(/ /g, "-");
                loc = loc.replace(/,/g, "");
                $('input[name=loc]').val(loc);
            }
        });

    }

    function showError(error) {
        var x = "";
        switch (error.code) {
            case error.PERMISSION_DENIED:
                x = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x = "An unknown error occurred."
                break;
        }
        alert(x);
    }


    function disconnect_facebook() {
        updateSocialOptions({
            is_connect_fb: 0,
            message: "Disconnected from Facebook"
        });
    }

    function disconnect_google() {
        updateSocialOptions({
            is_connect_google: 0,
            message: "Disconnected from Google"
        });
    }

    function disconnect_twitter() {
        updateSocialOptions({
            is_connect_twitter: 0,
            message: "Disconnected from Twitter"
        });
    }

    $('#social_connection').on('click', '.facebook_connect', function() {
        console.log("facebook_connect");
        fblogin_for_connect();
    })
    $('#social_connection').on('click', '.google_connect', function() {
        console.log("google_connect");
        google_login_for_connect();
    })
    $('#social_connection').on('click', '.twitter_connect', function() {
        console.log("twitter_connect");
    })

    function google_login_for_connect() {
        gapi.load('client:auth2', {
            callback: function() {
                // Initialize client & auth libraries
                gapi.client.init({
                    client_id: '220791968929-0t28vr2jeliutgtnmnbsgja2qt7iajq1.apps.googleusercontent.com',
                    cookiepolicy: 'single_host_origin',
                    scope: 'profile email'
                }).then(
                    function(success) {},
                    function(error) {}
                );
            },
            onerror: function() {
                // Failed to load libraries
            }
        });
        gapi.auth2.getAuthInstance().signIn().then(
            function(success) {
                gapi.client.request({
                    path: 'https://www.googleapis.com/plus/v1/people/me'
                }).then(
                    function(success) {
                        // API call is successful

                        var user_info = JSON.parse(success.body);
                        var data = {
                            Google_Email: user_info['emails'][0]['value'],
                            Google_ID: user_info['id']
                        };
                        // user profile information
                        console.log(user_info);
                        updateSocialOptions({
                            is_connect_google: 1,
                            message: "Google Account info updated",
                            google_email: user_info['emails'][0]['value'],
                            googleid: user_info.id,
                            google_image: user_info['image']['url']
                        });


                    },
                    function(error) {
                        // Error occurred
                        console.log(error); //to find the reason
                    }
                );
            },
            function(error) {
                // Error occurred
                console.log(error); //to find the reason
            }
        );
    }

    function fblogin_for_connect() {
        FB.login(function(response) {
            if (response.authResponse) {
                //  console.log(response);
                // Get and display the user profile data
                getFbUserData_for_connect();
            } else {
                document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
            }
        }, {
            scope: 'email'
        });
    }

    function twitter_connect() {
        // console.log("test");
        var screenX = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
            screenY = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
            outereview_idth = typeof window.outereview_idth != 'undefined' ? window.outereview_idth : document.body.clientWidth,
            outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
            width = 530,
            height = 470,
            left = parseInt(screenX + ((outereview_idth - width) / 2), 10),
            top = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
            features = (
                'width=' + width +
                ',height=' + height +
                ',left=' + left +
                ',top=' + top
            );
        newwindow = window.open("<?= $this->Url->build(['controller' => "Account", 'action' => 'twitterLogin'], ['fullBase' => true]); ?>", 'Login_by_Twitter', features);
        console.log(newwindow);
        if (window.focus) {
            newwindow.focus();
        }
        return false;
    }

    function connect_load_for_childwindow() {
        // load_connection_data();
        // social_side_connection();
    }

    function getFbUserData_for_connect() {
        FB.api('/me', {
                locale: 'en_US',
                fields: 'id,first_name,last_name,email,link,gender,locale,picture'
            },
            function(response) {
                // console.log(response);

                updateSocialOptions({
                    is_connect_fb: 1,
                    message: "Facebook Account info updated",
                    facebook_email: response.email,
                    facebookid: response.id,
                    facebook_image: response.picture.data.url
                });



            });
    }

    function load_connection_data() {
        // $.ajax({
        //     url: base_url + "account/get_connection_data",
        //     method: "post",
        //     cache: false,
        //     success: function(data) {
        //         // console.log(data);
        //         $("#social_connection").html(data);
        //     },
        //     error: function(error) {
        //         console.log(error);
        //     }
        // });
    }

    function social_side_connection() {
        // $.ajax({
        //     url: base_url + "account/social_side_connection",
        //     method: "post",
        //     cache: false,
        //     success: function(data) {
        //         // console.log(data);
        //         $("#social_side_connection").html(data);
        //     },
        //     error: function(error) {
        //         console.log(error);
        //     }
        // });
    }

    function previewImage() {
        // document.getElementById('ad_url').value = $('#ad_image').value;
        var preview = document.querySelector('.preview_image'); //selects the query named img
        var file = document.querySelector('input[id=uploadphoto]').files[0]; //sames as here

        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
            //document.getElementById('ad_name').value = file['name'];
        }

        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
            //console.log(reader);
        } else {
            preview.src = "";
        }
    }

    function regUserImageUpload() {
        var preview = document.querySelector('.preview_image'); //selects the query named img
        var file = document.querySelector('input[id=regUserImg]').files[0]; //sames as here
        // console.log(file);
        if (file) {
            var reader = new FileReader();
            reader.onloadend = function() {
                $(".after_login_img").attr("src", reader.result);
                $(".imagechange").attr("src", reader.result);
                //document.getElementById('ad_name').value = file['name'];

                userImageAjaxUpload(reader.result);
            }
            if (typeof file != "undefined" && file) {
                reader.readAsDataURL(file); //reads the data as a URL
                //console.log(reader);
            }
        } else {
            toastr.error("Could not upload image");
        }


    }


    function accountImageUpload() {

        console.log("saved new photo");
        var preview = document.querySelector('.profile_image'); //selects the query named img
        var file = document.querySelector('input[id=uploadphoto]').files[0]; //sames as here
        // console.log(file);
        if (file) {
            var reader = new FileReader();
            reader.onloadend = function() {
                preview.src = reader.result;
                //document.getElementById('ad_name').value = file['name'];
                userImageAjaxUpload(reader.result);
            }

            if (typeof file != "undefined" && file) {
                reader.readAsDataURL(file); //reads the data as a URL
                //console.log(reader);
            }
        } else {
            preview.src = $("input[id=profile_withsocial]").val();

        }

        Custombox.modal.close();
    }

    function userImageAjaxUpload(image_data) {
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'userImageAjaxUpload']); ?>",
            cache: false,
            // contentType: false,
            // processData: false,
            data: {
                file: image_data
            },
            type: 'post',
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(response) {
                toastr.error("Could not upload image upload", "Please try again");
                // $('#msg').html(response); // display error response from the server
            }
        });
    }

    function getBlockUnblockBox(user_id) {
        $('#block_unblock_box').fadeOut("fast");
        $.ajax({
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
            },
            url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getBlockUnblockBox']); ?>",
            cache: false,
            data: {
                user_id: user_id
            },
            type: 'post',
            success: function(response) {
                $('#block_unblock_box').html(response).fadeIn();
            },
            error: function(response) {

            }
        });
    }

    function google_for_profile() {
        gapi.load('client:auth2', {
            callback: function() {
                // Initialize client & auth libraries
                gapi.client.init({
                    client_id: '220791968929-0t28vr2jeliutgtnmnbsgja2qt7iajq1.apps.googleusercontent.com',
                    cookiepolicy: 'single_host_origin',
                    scope: 'profile email'
                }).then(
                    function(success) {},
                    function(error) {}
                );
            },
            onerror: function() {
                // Failed to load libraries
            }
        });
        gapi.auth2.getAuthInstance().signIn().then(
            function(success) {
                gapi.client.request({
                    path: 'https://www.googleapis.com/plus/v1/people/me'
                }).then(
                    function(success) {
                        // API call is successful

                        var user_info = JSON.parse(success.body);
                        var image = user_info['image']['url'];
                        var html = '<img data-toggle="tooltip" title="Google" style="height:100px;width:100px;cursor:pointer;" class="img-fluid border rounded-circle google_image social-images-profile" src="' + image + '" alt="Image Description">'
                        $('.profile_photos').append(html);
                        $('.google_profile').css('display', 'none');
                        $('[data-toggle="tooltip"]').tooltip();

                    },
                    function(error) {
                        // Error occurred
                        console.log(error); //to find the reason
                    }
                );
            },
            function(error) {
                // Error occurred
                console.log(error); //to find the reason
            }
        );
    }

    function twitter_for_profile() {
        var screenX = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
            screenY = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
            outereview_idth = typeof window.outereview_idth != 'undefined' ? window.outereview_idth : document.body.clientWidth,
            outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
            width = 530,
            height = 470,
            left = parseInt(screenX + ((outereview_idth - width) / 2), 10),
            top = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
            features = (
                'width=' + width +
                ',height=' + height +
                ',left=' + left +
                ',top=' + top
            );
        newwindow = window.open("<?= $this->Url->build(['controller' => "Account", 'action' => 'twitterLogin'], ['fullBase' => true]); ?>" + "?type=profile", 'Login_by_Twitter', features);
        console.log(newwindow);
        if (window.focus) {
            newwindow.focus();
        }
        return false;
    }
    var twitter_image = "";

    function twitter_for_profile2(image) {
        console.log("test");
        console.log(image);
        var html = '<img data-toggle="tooltip" title="Twitter" style="height:100px;width:100px;cursor:pointer;" class="img-fluid border rounded-circle twitter_image social-images-profile" src="' + image + '" alt="Image Description">'
        $('.profile_photos').append(html);
        $('.twitter_profile').css('display', 'none');
        $('[data-toggle="tooltip"]').tooltip();
    }

    function fblogin_for_profile() {
        FB.login(function(response) {
            if (response.authResponse) {
                //  console.log(response);
                // Get and display the user profile data
                getimagefacebook();
            } else {
                document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
            }
        }, {
            scope: 'email'
        });
    }

    function getimagefacebook() {
        // 	if(typeof Custombox != null)Custombox.modal.close();
        // Custombox.modal.close();
        FB.api('/me', {
                locale: 'en_US',
                fields: 'id,first_name,last_name,email,link,gender,locale,picture'
            },
            function(response) {
                var image = response.picture.data.url;
                var html = '<img data-toggle="tooltip" title="Facebook" style="height:100px;width:100px;cursor:pointer;" class="img-fluid border rounded-circle facebook_image social-images-profile" src="' + image + '" alt="Image Description">'
                $('.profile_photos').append(html);
                $('.facebook_profile').css('display', 'none');
                $('[data-toggle="tooltip"]').tooltip();

            });
    }


    function getCitiesDropdown(selected_state_id) {
        if (selected_state_id) {
            // $('#subcatdiv').hide("slow");
            $('#citydiv').fadeOut();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'getCitiesDropdown']); ?>",
                data: {
                    selected_state_id: selected_state_id,
                    city_id: "<?= !empty($user->city_id) ? $user->city_id : (!empty($business) ? $business->city_id : '') ?>",
                },
                method: "post",
                success: function(response) {
                    $('#citydiv').html(response);
                    $('#citydiv').fadeIn("slow", function() {
                        // $('.selectpicker').selectpicker('destroy');
                        $('.city_select').select2({
                            placeholder: 'Choose a city',
                            theme: "classic",
                            // theme: "bootstrap4"
                        });
                    });


                },
                error: function(error) {
                    console.log(error);
                }
            });

        }

    }


    $(document).ready(function() {

        new Readmore('.readmorelink', { //https://github.com/jedfoster/Readmore.js/tree/version-3.0
            speed: 500,
            collapsedHeight: 35,
            // blockCSS: 'display: block; width: 100%;',
            // lessLink: '<a href="#">Read less</a>'
        });
        // new Readmore('.filtergrid', { //https://github.com/jedfoster/Readmore.js/tree/version-3.0
        //     speed: 500,
        //     collapsedHeight: 500,
        //     // blockCSS: 'display: block; width: 100%;',
        //     // lessLink: '<a href="#">Read less</a>'
        // });

        blockresultmodal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#blockresultmodal'
            }

        });
        unblockresultmodal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#unblockresultmodal'
            }

        });

        jQuery(document).on('click', '.resend_confirmation_email', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'sendConfirmationEmail']); ?>",
                data: {
                    'id': id
                },
                success: function(data) {
                    unblock();
                    if (data.success) {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });
        });

        jQuery(document).on('click', '.unfollow', function(e) {
            e.preventDefault();
            unfollowBtn = $(this);
            if (loggedIn) {
                // alert("calling unfollow");
                unfollowUserAction();
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                unfollowUser = true;
            }
        });

        jQuery(document).on('click', '.follow', function(e) {
            e.preventDefault();
            followBtn = $(this);
            if (loggedIn) {
                followUserAction();
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                followUser = true;
            }
        });

        jQuery(document).on('click', '.block_user', function(e) {
            e.preventDefault();
            var targetuser_id = $(this).data('targetuser_id');
            var user = $(this).data('user');
            $('.blockeduser').html(user);
            block();
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'blockUser']); ?>",
                data: {
                    'user_id': targetuser_id
                },
                success: function(data) {
                    unblock();
                    if (data.success) {
                        $('.block_user').css('display', 'none');
                        $('.unblock_user').css('display', 'block');
                        // $this.addClass("unblock_user");
                        blockresultmodal.open();
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });
        });


        jQuery(document).on('click', '.unblock_user', function(e) {
            e.preventDefault();
            var targetuser_id = $(this).data('targetuser_id');
            var user = $(this).data('user');
            $('.unblockeduser').html(user);
            block();
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'unblockUser']); ?>",
                data: {
                    'user_id': targetuser_id
                },
                success: function(data) {
                    unblock();
                    if (data.success) {
                        $('.block_user').css('display', 'block');
                        $('.unblock_user').css('display', 'none');
                        unblockresultmodal.open();
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });


        });


        jQuery(document).on('click', '.uploadpc', function(e) {
            $('.file').trigger("click");
        });

        jQuery(document).on('click', '.loginn', function(e) {
            e.preventDefault();
            $('.signuphide').hide();
            $('.loginhide').show();
        });
        jQuery(document).on('click', '.signinn', function(e) {
            $('.loginhide').hide();
            $('.signuphide').show();
        });


        // $('#main_category').on('change', function() {
        jQuery(document).on('change', '#main_category', function(e) {
            var cate = $(this).val();
            $.ajax({
                type: "POST",
                url: base_url + "/search/get_children_categories",
                data: {
                    C_parent_tag_id: cate,
                },
                cache: false,
                success: function(data) {
                    console.log(data);
                    $("#children_cate_container").html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            })
        });

        $('.select2').select2({
            placeholder: 'Select an option',
            theme: "classic"
        });

        $('.categories_select').select2({
            theme: "classic",
            placeholder: "Choose a category",
            allowClear: true,
            maximumSelectionLength: 3,
        });

        $('.select2_multiple').select2({
            theme: "classic",
            placeholder: "Select one or more options",
            allowClear: true,
            maximumSelectionLength: 7,
        });

        $('#select2ajax').on('select2:select', function(e) {
            var data = e.params.data;
            var newOption = new Option(data.name, data.id, true, true);
            $('#select2ajax').append(newOption).trigger('change');
        });

        $('.timepicker-no-seconds').timepicker({
            autoclose: true,
            showSeconds: false,
            minuteStep: 10
        });

        getCitiesDropdown($("#state_id").val());
        jQuery(document).on('change', '.state_select', function(e) {
            //var selections = ( JSON.stringify($(this).select2('data')) );
            var selected_state_id = $(this).select2('val');
            getCitiesDropdown(selected_state_id);

        });


        // $('#state_id').on('select2:select', function(e) {
        //     alert("changed state select");
        // });


        var modal = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#uploadphoto_modal'
            }
        });
        $('.filedialog_open').click(function() {
            $('#uploadphoto').trigger("click");
            // modal.open();
        });
        $('.upload_new_pic').click(function() {
            modal.open();
        })

        $('.profile_photos').on('click', '.social-images-profile', function() {
            console.log("test");
            $('.profile_photos img').removeClass("selectimage");
            $(this).addClass("selectimage");
            if ($(this).hasClass('google_image')) {
                $('input[id=profile_withsocial]').val($(this).attr('src'));
                $('input[id=select_photo]').val("google");
            } else if ($(this).hasClass('facebook_image')) {
                $('input[id=profile_withsocial]').val($(this).attr('src'));
                $('input[id=select_photo]').val("facebook");
            } else if ($(this).hasClass('twitter_image')) {
                $('input[id=profile_withsocial]').val($(this).attr('src'));
                $('input[id=select_photo]').val("twitter");
            } else if ($(this).hasClass('preview_image')) {
                $('input[id=profile_withsocial]').val("");
                $('input[id=select_photo]').val("upload");
            }
        });


        $(".datepicker").datepicker({
            format: 'dd-mm-yyyy',
            // format: 'yyyy/mm/dd',
        });

        jQuery(document).on('click', '.photo_helpful', function() {
            var $this = $(this);
            // var business_id = $(this).data('business_id');
            var photo_id = $(this).data('photo_id');
            var is_review_photo = $(this).data('is_review_photo');

            if (loggedIn) {
                $.ajax({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                        xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                    },
                    type: "POST",
                    url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'helpfulPhoto']); ?>",
                    data: {
                        photo_id: photo_id,
                        is_review_photo: is_review_photo
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data.success) {
                            $this.find('.tooltiptext').text(data.count);
                            $this.find('.tooltiptext').css('display', 'inline');
                            $('body .gallery_item_' + photo_id).attr('data-helfulc', data.count);
                            // $this.addClass("text-dark");
                            $this.addClass("text-primary");

                            // if (data.count == 1) {
                            //     var count_text = "1 person found this helpful.";
                            // } else {
                            //     var count_text = data.count + " people found this helpful.";
                            // }
                            // $('#helpfulcount' + review_id).text(count_text);

                            // if (helpful_review_action) { //give
                            //     helpful_review_el.removeClass("text-dark");
                            //     helpful_review_el.addClass("text-primary");
                            //     helpful_review_el.removeClass('give_helpful_review');
                            //     helpful_review_el.addClass('ungive_helpful_review');
                            // } else {
                            //     helpful_review_el.addClass("text-dark");
                            //     helpful_review_el.removeClass("text-primary");
                            //     helpful_review_el.addClass('give_helpful_review');
                            //     helpful_review_el.removeClass('ungive_helpful_review');
                            // }

                            // $('#helpfulcount' + bphotoid).text(count_text);
                            // $($this).addClass("gave_photo_helpful");
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        unblock();
                    }
                });
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                // photoReport = true;
            }

        });


        jQuery(document).on('click', '.claim_business', function(e) {
            // console.log($(this).data('business_id'));
            // photoReportButton = $(this);
            e.preventDefault();
            if (loggedIn) {
                openClaimModal();
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                claimBusiness = true;
            }
        });

        jQuery(document).on('click', '.photo_report', function(e) {
            // console.log($(this).data('business_id'));
            e.preventDefault();
            photoReportButton = $(this);
            if (loggedIn) {
                openPhotoReport(photoReportButton);
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                photoReport = true;
            }
        });


        jQuery(document).on('click', '.set_as_primary', function(e) {
            // console.log($(this).data('business_id'));
            e.preventDefault();
            block();
            var photo_id = $(this).data('photo_id');
            var is_review_photo = $(this).data('is_review_photo');
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'setPrimary']); ?>",
                data: {
                    photo_id: photo_id,
                    is_review_photo: is_review_photo
                },
                success: function(response) {
                    unblock();
                    if (response.success) {
                        window.location.href = "<?= $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]); ?>";
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });
        });
        jQuery(document).on('click', '.add_to_slide', function(e) {
            // console.log($(this).data('business_id'));
            e.preventDefault();
            block();
            var $this = $(this);
            var photo_id = $(this).data('photo_id');
            var is_review_photo = $(this).data('is_review_photo');
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'setSlide']); ?>",
                data: {
                    photo_id: photo_id,
                    is_review_photo: is_review_photo
                },
                success: function(data) {
                    unblock();
                    if (data.success) {
                        if (data.upgrade) {
                            window.location.href = "<?= $this->Url->build(['prefix' => false, 'controller' => 'biz', 'action' => 'upgrade']); ?>";
                        } else {

                            $this.addClass('remove_from_slide');
                            $this.removeClass('add_to_slide');
                            $this.text('Remove from Slide');
                            toastr.success("Done");
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });
        });
        jQuery(document).on('click', '.remove_from_slide', function(e) {
            // console.log($(this).data('business_id'));
            e.preventDefault();
            block();
            var $this = $(this);
            var photo_id = $(this).data('photo_id');
            var is_review_photo = $(this).data('is_review_photo');
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'removeSlide']); ?>",
                data: {
                    photo_id: photo_id,
                    is_review_photo: is_review_photo
                },
                success: function(data) {
                    unblock();
                    if (data.success) {
                        $this.removeClass('remove_from_slide');
                        $this.addClass('add_to_slide');
                        $this.text('Add to Slide');
                        toastr.success("Done");
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });
        });


        jQuery(document).on('submit', '#reportprofile', function(e) {
            e.preventDefault();
            if (!$(this).valid()) return false;
            profileReportForm = $(this);
            if (loggedIn) {
                profileReportAction();
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                profileReport = true;
            }
        });

        jQuery(document).on('click', '.user_register', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            if (!form.valid()) return false;
            registerUser(form);

        });

        jQuery(document).on('click', '.sendmessage', function(e) {
            sendMessageButton = $(this);
            if (loggedIn) {
                openSendMessageModal();
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                sendMessage = true;
            }
        });

        jQuery(document).on('click', '.biz_add_photo', function(e) {
            if (loggedIn) {
				addPhotosPage();
			} else {
				$('.signuphide').hide();
				$('.loginn').trigger('click');
				addPhotos = true;
			}
        });
        jQuery(document).on('click', '.recommendYes', function(e) {
            if (loggedIn) {
				addReviewConfirm('yes');
			} else {
				$('.signuphide').hide();
				$('.loginn').trigger('click');
				addReviewYes = true;
			}
        });
        jQuery(document).on('click', '.recommendNo', function(e) {
            if (loggedIn) {
				addReviewConfirm('no');
			} else {
				$('.signuphide').hide();
				$('.loginn').trigger('click');
				addReviewNo = true;
			}
        });

        jQuery(document).on('click', '.report_profile', function(e) {
            reportProfileButton = $(this);
            if (loggedIn) {
                openReportProfileModal();
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                reportProfile = true;
            }
        });

        jQuery(document).on('submit', '#sendmessageform', function(e) {
            e.preventDefault();
            if (!$(this).valid()) return false;
            var data = $(this).serialize();

            // console.log(data);

            block();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'sendUserMessage']); ?>",
                data: data,
                success: function(data) {
                    // console.log(data);
                    unblock();
                    Custombox.modal.close();
                    if (data.success) {
                        $('#sendmessageform textarea').val("");
                        messagesuccessmodal.open();
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });

        });


        jQuery(document).on('submit', '#reportphotoform', function(e) {
            e.preventDefault();

            if (!$(this).valid()) return false;
            var data = $(this).serialize();

            block();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'reportPhoto']); ?>",
                data: data,
                success: function(data) {
                    // console.log(data);
                    unblock();
                    var photo_id = $('#reportphotoform input[name=photo_id]').val();
                    // $('#reportphotoform input[name=business_id]').val("");
                    $('#reportphotoform input[name=photo_id]').val("");
                    $('#reportphotoform input[name=is_review_photo]').val("");
                    $('#reportphotoform textarea').val("");
                    // $('body .photo_report').find('[data-photo_id="' + photo_id + '"]').removeClass('photo_report');
                    photoReportButton.removeClass('photo_report');
                    Custombox.modal.close();
                    succss_modal.open();
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });

        });

        jQuery(document).on('submit', '#reportanswerform', function(e) {
            e.preventDefault();

            if (!$(this).valid()) return false;
            var data = $(this).serialize();
            // console.log(data);

            block();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'reportAnswer']); ?>",
                data: data,
                success: function(response) {
                    // console.log(data);
                    unblock();
                    if (response.success) {
                        $('#reportanswerform input[name=answer_id]').val("");
                        $('#reportanswerform textarea').val("");
                        Custombox.modal.close();
                        succss_modal.open();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });


        });

        jQuery(document).on('submit', '#reportquestionform', function(e) {
            e.preventDefault();

            if (!$(this).valid()) return false;
            var data = $(this).serialize();
            block();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'reportQuestion']); ?>",
                data: data,
                success: function(response) {
                    // console.log(data);
                    unblock();
                    if (response.success) {
                        $('#reportquestionform input[name=question_id]').val("");
                        $('#reportquestionform textarea').val("");
                        Custombox.modal.close();
                        succss_modal.open();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });

        });

        jQuery(document).on('submit', '#reportownerform', function(e) {
            e.preventDefault();

            if (!$(this).valid()) return false;
            var data = $(this).serialize();
            // console.log(data);
            block();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'reportOwnerReply']); ?>",
                data: data,
                success: function(response) {
                    // console.log(data);
                    unblock();
                    if (response.success) {
                        $('#reportownerform input[name=review_id]').val("");
                        $('#reportownerform textarea').val("");
                        Custombox.modal.close();
                        succss_modal.open();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });
        });


        jQuery(document).on('submit', '#postquestionform', function(e) {
            e.preventDefault();
            questionForm = $(this);
            if (loggedIn) {
                postQuestionForm();
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                postQuestion = true;
            }
        });


        jQuery(document).on('submit', '#reportreviewform', function(e) {
            e.preventDefault();

            if (!$(this).valid()) return false;
            var data = $(this).serialize();
            // console.log(data);

            block();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'reportReview']); ?>",
                data: data,
                success: function(response) {
                    // console.log(data);
                    unblock();
                    if (response.success) {
                        $('#reportreviewform input[name=review_id]').val("");
                        $('#reportreviewform input[name=business_id]').val("");
                        $('#reportreviewform textarea').val("");
                        Custombox.modal.close();
                        succss_modal.open();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });

        });



        jQuery(document).on('click', '.biz_save', function(e) {
            var business_id = $(this).data('business_id');
            if (loggedIn) {
                getCollections(business_id);
            } else {
                $('.signuphide').hide();
                $('.loginn').trigger('click');
                isSaveCollection = true;
            }

        });

        jQuery(document).on('click', '.delete_photo', function(e) {
            var photo_id = $(this).data('photo_id');
            var is_review_photo = $(this).data('is_review_photo');


            block();
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'deletePhoto']); ?>",
                data: {
                    photo_id: photo_id,
                    is_review_photo: is_review_photo
                },
                success: function(response) {
                    unblock();
                    if (response.success) {
                        window.location.href = "<?= $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true]); ?>";
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });

        });


        jQuery(document).on('click', '.save_list', function(e) {
            e.preventDefault();
            var parent = $(this).parent();
            block();
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'saveBusinessToCollection']); ?>",
                data: {
                    business_id: $(this).data('business_id'),
                    collection_id: $(this).data('value')
                },
                success: function(response) {
                    unblock();
                    if (response.success) {
                        toastr.success(response.message);
                        // console.log(parent);
                        parent.find('.save_list').css('display', 'none');
                        parent.find('.remove_list').css('display', 'inline-block');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });

        });

        jQuery(document).on('click', '.remove_list', function(e) {
            e.preventDefault();
            var parent = $(this).parent();
            // console.log('business_id-->' + business['Business_id']);
            // console.log('coll--->' + $(this).data('value'));
            block();

            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'removeBusiness']); ?>",
                data: {
                    business_id: $(this).data('business_id'),
                    collection_id: $(this).data('value')
                },
                success: function(response) {
                    unblock();
                    if (response.success) {
                        toastr.info(response.message);
                        parent.find('.remove_list').css('display', 'none');
                        parent.find('.save_list').css('display', 'inline-block');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });


        });

        jQuery(document).on('click', '.cancel_subscription', function(e) {
            e.preventDefault();
            openCancelSubscriptionModal($(this));
        });

        jQuery(document).on('click', '.notification_link', function(e) {
            e.preventDefault();
            var id = $(this).data("notificationid");
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'viewedNotification']); ?>",
                data: {
                    id: id
                },
                success: function(response) {

                },
                error: function(error) {}
            });

            window.location.href = $(this).attr("href");
        });


        $('#new_collection').submit(function(e) {
            e.preventDefault();

            if (!$(this).valid()) return false;

            block();
            var collectionName = $('#collectionName').val();
            var collectionDescription = $('#collectionDescription').val();
            var private = $("input[name='private']:checked").val();
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken') ?>');
                    xhr.setRequestHeader('_csrfToken', '<?= $this->request->getParam('_csrfToken') ?>');
                },
                type: "POST",
                url: "<?= $this->Url->build(['prefix' => false, 'controller' => 'Api', 'action' => 'saveCollection']); ?>",
                data: {
                    name: collectionName,
                    description: collectionDescription,
                    private: private,
                },
                success: function(response) {
                    unblock();
                    if (response.success) {
                        Custombox.modal.close();
                        toastr.success(response.message);
                        $('#collectionName').val("");
                        $('#collectionDescription').val("");
                        getCollections();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                    unblock();
                }
            });
        });

        $("[rel='tooltip']").tooltip();

        $('.thumbnail').hover(
            function() {
                $(this).find('.caption').slideDown(250); //.fadeIn(250)
            },
            function() {
                $(this).find('.caption').slideUp(250); //.fadeOut(205)
            }
        );


        // $('timerange').daterangepicker({
        //     timePicker: true,
        //     startDate: moment().startOf('hour'),
        //     endDate: moment().startOf('hour').add(32, 'hour'),
        //     locale: {
        //         format: 'M/DD hh:mm A'
        //     }
        // });

    });
</script>