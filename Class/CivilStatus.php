<?php
    class CivilStatus {
        private static $statuses = [
            "Single", "Married", "Widowed", "Legally Separate", "Other"
        ];

        public static function getOptions($selected = '') {
            $options = "<option value=''>Select civil status</option>";
            foreach (self::$statuses as $status) {
                $isSelected = ($selected === $status) ? 'selected' : '';
                $options .= "<option value='$status' $isSelected>$status</option>";
            }
            return $options;
        }
}