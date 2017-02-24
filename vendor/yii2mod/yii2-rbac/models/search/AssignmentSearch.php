<?php

namespace yii2mod\rbac\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class AssignmentSearch
 *
 * @package yii2mod\rbac\models\search
 */
class AssignmentSearch extends Model
{
    /**
     * @var string user id
     */
    public $id;

    /**
     * @var string username
     */
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param \yii\db\ActiveRecord $class
     * @param $idField
     * @param string $usernameField
     *
     * @return ActiveDataProvider
     */
    public function search($params, $class, $idField, $usernameField)
    {
        $query = $class::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([$idField => $this->id]);
        $query->andFilterWhere(['like', $usernameField, $this->username]);

        return $dataProvider;
    }
}