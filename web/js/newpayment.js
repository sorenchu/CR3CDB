var $collectionHolder;
var $addPaymentLink = $('<a href="#" class="add_payment_link">Añade un pago</a>');
var $newLinkLi = $('<li></li>').append($addPaymentLink);

jQuery(document).ready(function() {
    $collectionHolder = $('ul.payments');
    $collectionHolder.append($addPaymentLink);

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addPaymentLink.on('click', function(e) {
        e.preventDefault();
        addPaymentForm($collectionHolder, $addPaymentLink);
    });

    $collectionHolder.find('li').each(function() {
        addPaymentFormDeleteLink($(this));
    });
});

function addPaymentForm($collectionHolder, $addPaymentLink) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);
    $addPaymentLink.before($newFormLi);
}

function addPaymentFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#">Borrar pago</a>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}
