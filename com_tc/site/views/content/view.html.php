<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Tc
 * @author     Parth Lawate <contact@techjoomla.com>
 * @copyright  2016 Parth Lawate
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View to edit
 *
 * @since  1.6
 */
class TcViewContent extends JViewLegacy
{
	/**
	 * Display the view
	 *
	 * @param   string  $tpl  Template name
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function display($tpl = null)
	{
		$app        = JFactory::getApplication();
		$input = JFactory::getApplication()->input;
		$this->content_id = $input->get('content_id', '', 'INT');
		$this->layout     = $input->get('layout', 'default', 'STRING');
		$this->user_id    = JFactory::getUser()->id;

		if (!$this->user_id && $this->layout != 'terms')
		{
			$app->redirect(JRoute::_(JURI::base()));

			return false;
		}

		require_once JPATH_ADMINISTRATOR . '/components/com_tc/models/content.php';

		// Call api to get user accepted version
		$model                         = JModelLegacy::getInstance('Content', 'TcModel');
		$this->termsandconditions            = $model->getItem($this->content_id);
		parent::display($tpl);
	}
}
