<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@images', dirname(dirname(dirname(__DIR__))) . 'public_html/uploads/images');
Yii::setAlias('@scripts', dirname(dirname(__DIR__)) . '/frontend/scripts');

Yii::setAlias('@frontendUrl', getenv('FRONTEND_URL'));