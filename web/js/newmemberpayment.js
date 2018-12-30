var $memberCollectionHolder;
var $addMemberPaymentLink = $('<a href="#" class="add_payment_link">Añade un pago</a>');
var $newLinkLi = $('<li></li>').append($addMemberPaymentLink);

jQuery(document).ready(function() {
    $memberCollectionHolder = $('ul.memberpayments');
    $memberCollectionHolder.append($addMemberPaymentLink);

    $memberCollectionHolder.data('index', $memberCollectionHolder.find(':input').length);

    $addMemberPaymentLink.on('click', function(e) {
        e.preventDefault();
        addMemberPaymentForm($memberCollectionHolder, $addMemberPaymentLink);
    });

    $memberCollectionHolder.find('li').each(function() {
        addMemberPaymentFormDeleteLink($(this));
    });
});

function addMemberPaymentForm($memberCollectionHolder, $addMemberPaymentLink) {
    var prototype = $memberCollectionHolder.data('prototype');
    var index = $memberCollectionHolder.data('index');

    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);

    $memberCollectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);
    $addMemberPaymentLink.before($newFormLi);
}

function addMemberPaymentFormDeleteLink($paymentFormLi) {
    var $removeFormA = $('<a href="#">Borrar pago</a>');
    $paymentFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        e.preventDefault();
        $paymentFormLi.remove();
    });
}
