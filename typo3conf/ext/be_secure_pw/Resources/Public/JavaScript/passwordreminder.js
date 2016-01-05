/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Password reminder window appearing in the backend
 */
Ext.namespace('Ext.ux.TYPO3');

Ext.ux.TYPO3.passwordReminder = Ext.extend(Ext.util.Observable, {
	isUnloading: false,
	logoutButton: null,

	constructor: function (config) {
		config = config || {};
		Ext.apply(this, config);

		this.initComponents();
		this.execute.defer(3000, this);
		this.logoutButton = Ext.DomQuery.selectNode('#logout-button input');

		Ext.ux.TYPO3.passwordReminder.superclass.constructor.call(this, config);
	},

	execute: function () {
		this.passwordReminderWindow.show();
	},

	initComponents: function () {
		this.passwordReminderWindow = new Ext.Window({
			width: 450,
			autoHeight: true,
			closable: false,
			resizable: false,
			plain: true,
			border: false,
			modal: true,
			draggable: false,
			closeAction: 'hide',
			id: 'passwordReminderWindow',
			cls: 't3-window',
			title: TYPO3.LLL.beSecurePw.passwordReminderWindow_title,
			html: TYPO3.LLL.beSecurePw.passwordReminderWindow_message,
			buttons: [
				{
					scope: this,
					icon: this.getChangeIcon(),
					text: TYPO3.LLL.beSecurePw.passwordReminderWindow_button_changePassword,
					handler: this.changePasswordAction
				},
				{
					scope: this,
					text: TYPO3.LLL.beSecurePw.passwordReminderWindow_button_postpone,
					handler: this.postponeAction
				}
			]
		});
	},

	unloadEventHandler: function (event) {
		event.stopEvent();
		this.isUnloading = true;
		this.passwordReminderWindow.show();
		this.removeUnloadEventListener();
	},

	changePasswordAction: function () {
		this.passwordReminderWindow.hide();
		top.goToModule('user_setup')
		this.continueUnloading();
	},

	postponeAction: function () {
		this.passwordReminderWindow.hide();
		this.addUnloadEventListener();
		this.continueUnloading();
	},

	getChangeIcon: function () {
		return TYPO3.configuration.PATH_typo3 + 'sysext/t3skin/images/icons/status/dialog-ok.png';
	},

	addUnloadEventListener: function () {
		if (!this.isUnloading) {
			Ext.EventManager.addListener(this.logoutButton, 'click', this.unloadEventHandler, this);
		}
	},

	removeUnloadEventListener: function () {
		Ext.EventManager.removeListener(this.logoutButton, 'click', this.unloadEventHandler, this);
	},

	continueUnloading: function () {
		if (this.isUnloading && this.logoutButton) {
			this.logoutButton.click();
		}
	}
});

/**
 * Initialize the donate widget
 */
Ext.onReady(function () {
	TYPO3.passwordReminder = new Ext.ux.TYPO3.passwordReminder();
});