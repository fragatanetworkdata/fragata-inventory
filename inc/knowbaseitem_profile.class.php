<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2012 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Julien Dombre
// Purpose of file:
// ----------------------------------------------------------------------

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access directly to this file");
}

/// Class KnowbaseItem_Profile
/// since version 0.83
class KnowbaseItem_Profile extends CommonDBRelation {

   // From CommonDBRelation
   public $itemtype_1 = 'KnowbaseItem';
   public $items_id_1 = 'knowbaseitems_id';
   public $itemtype_2 = 'Profile';
   public $items_id_2 = 'profiles_id';
   var $checks_only_for_itemtype1 = true;
   var $logs_only_for_itemtype1   = true;


   /**
    * Get profiles for a knowbaseitem
    *
    * @param $knowbaseitems_id ID of the knowbaseitem
    *
    * @return array of profiles linked to a knowbaseitem
   **/
   static function getProfiles($knowbaseitems_id) {
      global $DB;

      $prof  = array();
      $query = "SELECT `glpi_knowbaseitems_profiles`.*
                FROM `glpi_knowbaseitems_profiles`
                WHERE `knowbaseitems_id` = '$knowbaseitems_id'";

      foreach ($DB->request($query) as $data) {
         $prof[$data['profiles_id']][] = $data;
      }
      return $prof;
   }

}
?>