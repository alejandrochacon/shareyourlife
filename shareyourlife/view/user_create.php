<?php

$form = new Form('/user/doCreate');

echo $form->text()->label('Vorname')->name('firstName');
echo $form->text()->label('Nachname')->name('lastName');
echo $form->text()->label('Mail')->name('email');
echo $form->submit()->label('Benutzer erstellen')->name('send');

$form->end();
