<?php
declare(strict_types = 1);

namespace popp\ch12\batch08;


class AddVenueController extends PageController
{
    public function process()
    {
        $request = $this->getRequest();

        try {
            $name = $request->getProperty('venue_name');

            if (is_null($request->getProperty('submitted'))) {
                $request->addFeedback("choose a name for the venue");
                $this->render(__DIR__ . '/view/add_venue.php', $request);
            } elseif (is_null($name)) {
                $request->addFeedback("name is a required field");
                $this->render(__DIR__ . '/view/add_venue.php', $request);

                return;
            } else {
                // add to database
                // 视图文件全部使用小写字母
                $this->forward('listvenues.php');
            }

        } catch (Exception $e) {
            $this->render(__DIR__ . '/view/error.php', $request);
        }
    }
}
