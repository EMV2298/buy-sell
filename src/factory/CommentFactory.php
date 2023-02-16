<?php

namespace app\src\factory;

use app\models\Comments;
use Yii;
use yii\web\ServerErrorHttpException;

class CommentFactory
{
    /**
     * Сохраняет комментарий
     * @param int $offerId Id обьявления
     * @param string $text текст комментария
     * @return bool
     */
    public static function create(int $offerId, string $text): bool
    {
        $comment = new Comments();
        $comment->user_id = Yii::$app->user->getId();
        $comment->offer_id = $offerId;
        $comment->message = $text;
        if ($comment->save()) {
            return true;
        } else {
            throw new ServerErrorHttpException('Не удалось отправить комментарий');
        }
    }
}
