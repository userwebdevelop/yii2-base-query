<?php

namespace userwebdevelop\yii2BaseQuery;

use yii\db\ActiveQuery;

class BaseQuery extends ActiveQuery
{
    public function activeAndSorted()
    {
        return $this->active()->sortedBySort();
    }

    public function active()
    {
        return $this->andWhere(['status' => 1]);
    }

    public function sortedBySort()
    {
        return $this->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);
    }
    public function sortedByAttribute($attribute, $sortType = SORT_DESC)
    {
        return $this->orderBy([$attribute => $sortType, 'id' => SORT_DESC]);
    }
}
