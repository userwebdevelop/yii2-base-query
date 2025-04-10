<?php

namespace userwebdevelop\ogconfigpages;

use Yii;
use yii\db\Query;
use yii\db\Command;

class OgConfigPages     
{

    public function actionInstall()
    {
        $db = Yii::$app->db;
        $params = [
            ['OG_DESCRIPTION', '', '', 'Open Graph Description', 'text'],
            ['OG_IMAGE', '', '', 'Open Graph Image', 'text'],
            ['OG_TITLE', '', '', 'Open Graph Title', 'text'],
            ['OG_URL', '', '', 'Open Graph Url', 'text'],
        ];

        foreach ($params as $param) {
            $exists = (new Query())
                ->from('{{%config}}')
                ->where(['param' => $param[0]])
                ->exists();

            if (!$exists) {
                $db->createCommand()->insert('{{%config}}', [
                    'param' => $param[0],
                    'value' => $param[1],
                    'default' => $param[2],
                    'label' => $param[3],
                    'type' => $param[4],
                ])->execute();

                echo "Добавлен параметр: {$param[0]}\n";
            } else {
                echo "Параметр уже существует: {$param[0]}\n";
            }
        }
        $this->addColumnsToPage();
        echo "OpenGraph параметры успешно установлены.\n";
    }

    public function actionUninstall()
    {
        Yii::$app->db->createCommand()
            ->delete('{{%config}}', ['param' => [
                'OG_DESCRIPTION',
                'OG_IMAGE',
                'OG_TITLE',
                'OG_URL',
            ]])->execute();
        $this->removeColumnsFromPage();
        echo "OpenGraph параметры успешно удалены.\n";
    }
    private function addColumnsToPage()
    {
        $db = Yii::$app->db;
        if (!$db->schema->getTableSchema('{{%page}}')->getColumn('og_description')) {
            $db->createCommand()->addColumn('{{%page}}', 'og_description', $this->getColumnDefinition())->execute();
            echo "Добавлен столбец: og_description\n";
        }

        if (!$db->schema->getTableSchema('{{%page}}')->getColumn('og_image')) {
            $db->createCommand()->addColumn('{{%page}}', 'og_image', $this->getColumnDefinition())->execute();
            echo "Добавлен столбец: og_image\n";
        }

        if (!$db->schema->getTableSchema('{{%page}}')->getColumn('og_title')) {
            $db->createCommand()->addColumn('{{%page}}', 'og_title', $this->getColumnDefinition())->execute();
            echo "Добавлен столбец: og_title\n";
        }

        if (!$db->schema->getTableSchema('{{%page}}')->getColumn('og_url')) {
            $db->createCommand()->addColumn('{{%page}}', 'og_url', $this->getColumnDefinition())->execute();
            echo "Добавлен столбец: og_url\n";
        }
    }

    private function removeColumnsFromPage()
    {
        $db = Yii::$app->db;
        if ($db->schema->getTableSchema('{{%page}}')->getColumn('og_description')) {
            $db->createCommand()->dropColumn('{{%page}}', 'og_description')->execute();
            echo "Удален столбец: og_description\n";
        }

        if ($db->schema->getTableSchema('{{%page}}')->getColumn('og_image')) {
            $db->createCommand()->dropColumn('{{%page}}', 'og_image')->execute();
            echo "Удален столбец: og_image\n";
        }

        if ($db->schema->getTableSchema('{{%page}}')->getColumn('og_title')) {
            $db->createCommand()->dropColumn('{{%page}}', 'og_title')->execute();
            echo "Удален столбец: og_title\n";
        }

        if ($db->schema->getTableSchema('{{%page}}')->getColumn('og_url')) {
            $db->createCommand()->dropColumn('{{%page}}', 'og_url')->execute();
            echo "Удален столбец: og_url\n";
        }
    }
    private function getColumnDefinition()
    {
        return 'TEXT NULL';
    }
}
