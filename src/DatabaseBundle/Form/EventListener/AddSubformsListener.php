<?php
# src/DatabaseBundle/Form/EventListener/AddSubformsListener.php
namespace DatabaseBundle\Form\EventListener;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use DatabaseBundle\Form\Person\ParentDataType;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddSubformsListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents() 
    {
        return array(
            FormEvents::POST_SET_DATA => 'onPostSetData',
            FormEvents::PRE_SUBMIT    => 'onPreSubmit',
        );
    }

    public function onPostSetData(FormEvent $event)
    {
        $personalData = $event->getData();
        $form = $event->getForm();
        if ($personalData) {
            if ($personalData->getIsPlayer()) {
                $form->add('playerData', CollectionType::class,
                        array('entry_type' => PlayerDataType::class,
                            'allow_add' => true,
                            'by_reference' => false,)
                        );
            }
            if ($personalData->getIsCoach()) {
                $form->add('coachData', CollectionType::class,
                        array('entry_type' => CoachDataType::class,
                            'allow_add' => true,
                            'by_reference' => false,)
                        );
            }
            if ($personalData->getIsMember()) {
                $form->add('memberData', CollectionType::class,
                        array('entry_type' => MemberDataType::class,
                            'allow_add' => true,
                            'by_reference' => false,)
                        );
            }
            if ($personalData->getIsParent()) {
                $form->add('parentData', CollectionType::class,
                        array('entry_type' => ParentDataType::class,
                            'allow_add' => true,
                            'by_reference' => false,)
                        );
            }
        } 
    }

    public function onPreSubmit(FormEvent $event) 
    {
        $personalData = $event->getData();
        $form = $event->getForm();

        if (!$personalData) {
            return;
        }

#        if ($personalData['isPlayer'] and true === $personalData['isPlayer']) {
#            $form->add('playerData', CollectionType::class);
#        } else {
#            unset($personalData['playerData']);
#            $event->setData($personalData);
#        }
#
#        if (true === $personalData['isCoach']) {
#            $form->add('coachData', CollectionType::class);
#        } else {
#            unset($personalData['coachData']);
#            $event->setData($personalData);
#        }

        if (true === $personalData['isParent']) {
            $form->add('parentData', CollectionType::class);
        } else {
            unset($personalData['parentData']);
            $event->setData($personalData);
        }

#        if (true === $personalData['isMember']) {
#            $form->add('memberData', CollectionType::class);
#        } else {
#            unset($personalData['memberData']);
#            $event->setData($personalData);
#        }
    }
}
