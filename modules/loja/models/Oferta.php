<?php

namespace app\modules\loja\models;

use Yii;
use app\modules\base\models\Produto;
use app\modules\base\models\Produtor;

/**
 * This is the model class for table "Oferta".
 *
 * @property integer $oferta_id
 * @property string $momento
 * @property integer $quantidade
 * @property double $preco
 * @property integer $corrente
 * @property integer $produto_id
 * @property integer $produtor_id
 *
 * @property Produto $produto
 * @property Produtor $produtor
 * @property Pedido[] $pedidos
 */
class Oferta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Oferta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['momento'], 'safe'],
            [['quantidade', 'preco', 'produto_id', 'produtor_id'], 'required'],
            [['quantidade', 'corrente', 'produto_id', 'produtor_id'], 'integer'],
            [['preco'], 'number'],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['produto_id' => 'produto_id']],
            [['produtor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produtor::className(), 'targetAttribute' => ['produtor_id' => 'produtor_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oferta_id' => 'Identificador',
            'momento' => 'Momento da criação',
            'quantidade' => 'Quantidade em kg',
            'preco' => 'Preço por kg',
            'corrente' => 'Corrente',
            'produto_id' => 'Produto associado',
            'produtor_id' => 'Produtor associado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::className(), ['produto_id' => 'produto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutor()
    {
        return $this->hasOne(Produtor::className(), ['produtor_id' => 'produtor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['oferta_id' => 'oferta_id']);
    }
}
