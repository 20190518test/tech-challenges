<?php

namespace IWD\JOBINTERVIEW\Client\Webapp\Data;

use IWD\JOBINTERVIEW\Client\Webapp\Survey\Factory as SurveyFactory;

Class SurveyResult
{

    /**
     *  Extract all available survey's names
     *
     *  @param array $data
     *  @return array $output
     */
    public function getSurveyNames(array $data): array
    {
        $output = [];

        foreach ($data as $surveyCode => $survey) {
            $output[] = [
                'name' => $survey['name'],
                'code' => $surveyCode,
            ];
        }

        return $output;
    }

    /**
     *  Aggregate Survey results
     *
     *  @param array $surveyResults
     *  @return array $data
     *  @throws SurveyException
     */
    public function aggregateResults(array $surveyResults): array
    {
        $data = [];

        foreach ($surveyResults as $surveyType => $surveyResult) {

            $survey = SurveyFactory::factory($surveyType);
            $survey->aggregate($surveyResult);

            $data[] = $survey;
        }

        return $data;
    }

    /**
     *  Basic Loop to extract survey's data
     *
     *  @param array $aggregatedData
     *  @return array $output
     */
    public function output($aggregatedData): array
    {
        $output = [];

        foreach ($aggregatedData as $question) {
           $output[] = $question;
        }

        return $output;
    }
}
