<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fournisseur;

/**
 * FournisseurSearch represents the model behind the search form about `app\models\Fournisseur`.
 */
class FournisseurSearch extends Fournisseur
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gallery_photos', 'gallery_pdf', 'cree_par'], 'integer'],
            [['estPremium'], 'boolean'],
            [['nom', 'adresse', 'numtel', 'activite', 'siteweb', 'facebook', 'twitter'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Fournisseur::find();

        // add conditions that should always apply here
        //$this->addClientConditions($query);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'estPremium' => $this->estPremium,
            'gallery_photos' => $this->gallery_photos,
            'gallery_pdf' => $this->gallery_pdf,
        ]);

        $query->andFilterWhere(['like', 'nom', $this->nom])
            ->andFilterWhere(['like', 'adresse', $this->adresse])
            ->andFilterWhere(['like', 'numtel', $this->numtel])
            ->andFilterWhere(['like', 'activite', $this->activite])
            ->andFilterWhere(['like', 'siteweb', $this->siteweb])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'twitter', $this->twitter]);

        return $dataProvider;
    }
    
    public function addClientConditions($query)
    {
        if (!Yii::$app->user->isGuest && $cUser = Yii::$app->user->identity ) {
            $premium = 0;
            if ($abonnement = Abonnement::findOne(['client'=>$cUser->superieur0->id])) {
                $premium = $abonnement->acces_salles? [0,1] : 0;
            }
            $liste_employes = \yii\helpers\ArrayHelper::getColumn(User::getTeamOf($cUser->id), "id");
            $liste_admins = \yii\helpers\ArrayHelper::getColumn(User::find()->adminsNoClients()->all(), "id");
            $query->andWhere('false');
            $query->orWhere(['cree_par'=>$liste_employes]);
            $query->orWhere([ 'and' ,  ['est_premium'=>$premium]  ,  ['cree_par'=>$liste_admins]  ]);
        }
        
    }
}
