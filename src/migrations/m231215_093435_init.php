<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m231215_093435_init
 */
class m231215_093435_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->makeSurvey();
        $this->makeRespondent();
        $this->makeResponse();
        $this->makeSetting();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('setting');
        $this->dropTable('response');
        $this->dropTable('respondent');
        $this->dropTable('survey');
    }

    private function makeSurvey() {
        $this->createTable('survey', [
            'survey_id' => $this->primaryKey(),
            'status_id' => $this->integer()->notNull(),
            'key' => $this->string(45)->notNull()->comment("short unique id"),
            'uuid' => $this->string(45)->notNull(),
            'name' => $this->string(255)->notNull(),
            'external_id' => $this->string(255),
            'structure' => $this->json(),
            'time_created' => $this->dateTime(6),
            'time_updated' => $this->dateTime(6),
            'time_completed' => $this->dateTime(6)->null(),
        ]);

        $this->createIndex('ix_survey_status', 'survey', 'status_id');
        $this->createIndex('ix_survey_key', 'survey', 'key', true);
        $this->createIndex('ix_survey_name', 'survey', 'name', true);
        $this->createIndex('ix_survey_external', 'survey', 'external_id');
        $this->createIndex('ix_survey_uuid', 'survey', 'uuid', true);
        $this->createIndex('ix_survey_time_completed', 'survey', 'time_completed');
        $this->createIndex('ix_survey_time_created', 'survey', 'time_created');
        $this->createIndex('ix_survey_time_updated', 'survey', 'time_updated');

    }


    private function makeRespondent() : void
    {
        $this->createTable('respondent', [
            'respondent_id' => $this->primaryKey(),
            'survey_id' => $this->integer(),
            'language_id' => $this->integer(),
            'status_id' => $this->integer(),
            'key' => $this->string(45)->notNull()->comment("short unique id"),
            'uuid' => $this->string(45)->notNull(),
            'params' => $this->json()->null(),
            'time_created' => $this->dateTime(6),
            'time_updated' => $this->dateTime(6),
            'time_completed' => $this->dateTime(6)->null(),
        ]);

        $this->addForeignKey('fk_respondent_survey', 'respondent', 'survey_id', 'survey', 'survey_id',
            new Expression("CASCADE"), new Expression("CASCADE"));

        $this->createIndex('ix_respondent_status', 'respondent', 'status_id');
        $this->createIndex('ix_respondent_language', 'respondent', 'language_id');
        $this->createIndex('ix_respondent_key', 'respondent', 'key', true);
        $this->createIndex('ix_respondent_uuid', 'respondent', 'uuid', true);
        $this->createIndex('ix_respondent_time_created', 'respondent', 'time_created');
        $this->createIndex('ix_respondent_time_updated', 'respondent', 'time_updated');
        $this->createIndex('ix_respondent_time_completed', 'respondent', 'time_completed');

        $this->createIndex('ix_respondent_srv_status', 'respondent', ['survey_id', 'status_id']);
        $this->createIndex('ix_respondent_srv_language', 'respondent', ['survey_id', 'language_id']);
        $this->createIndex('ix_respondent_srv_time_created', 'respondent', ['survey_id', 'time_created']);
        $this->createIndex('ix_respondent_srv_time_updated', 'respondent', ['survey_id', 'time_updated']);
        $this->createIndex('ix_respondent_srv_time_completed', 'respondent', ['survey_id', 'time_completed']);
    }

    private function makeResponse() : void
    {


        $this->createTable('response', [
            'response_id' => $this->primaryKey(),
            'survey_id' => $this->integer(),
            'status_id' => $this->integer(),
            'nr' => $this->integer()->notNull(),
            'respondent_id' => $this->integer(),
            'uuid' => $this->string(45)->notNull(),
            'data' => $this->json()->null(),
            'time_created' => $this->dateTime(6)->notNull(),
            'time_updated' => $this->dateTime(6)->notNull(),
            'time_completed' => $this->dateTime(6)->null(),
        ]);

        $this->addForeignKey('fk_response_survey', 'response', 'survey_id', 'survey', 'survey_id',
            new Expression("CASCADE"), new Expression("CASCADE"));
        $this->addForeignKey('fk_response_respondent', 'response', 'respondent_id', 'respondent', 'respondent_id',
            new Expression("CASCADE"), new Expression("CASCADE"));

        $this->createIndex('ix_response_uuid', 'response', 'uuid', true);
        $this->createIndex('ix_response_status', 'response', 'status_id');
        $this->createIndex('ix_response_status_time_created', 'response', 'time_created');
        $this->createIndex('ix_response_status_time_updated', 'response', 'time_updated');
        $this->createIndex('ix_response_status_time_completed', 'response', 'time_completed');

        $this->createIndex('ix_response_srv_nr', 'response', ['survey_id', 'nr']);
        $this->createIndex('ix_response_srv_respondent', 'response', ['survey_id', 'respondent_id']);
        $this->createIndex('ix_response_srv_uuid', 'response', ['survey_id', 'uuid'], true);
        $this->createIndex('ix_response_srv_status', 'response', ['survey_id', 'status_id']);
        $this->createIndex('ix_response_srv_time_created', 'response', ['survey_id', 'time_created']);
        $this->createIndex('ix_response_srv_time_updated', 'response', ['survey_id', 'time_updated']);
        $this->createIndex('ix_response_srv_time_completed', 'response', ['survey_id', 'time_completed']);
    }



    private function makeSetting() : void
    {
        $this->createTable('setting', [
            'setting_id' => $this->primaryKey(),
            'name'  => $this->string(255)->notNull()->unique(),
            'value' => $this->text(),
        ]);
        $this->createIndex('ix_setting_name', 'setting', 'name', true);
        $this->insert('setting', ['name' => 'keyLength', 'value' => 1]);

    }
}
