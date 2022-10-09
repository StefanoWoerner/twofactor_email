<?php

declare(strict_types=1);

/**
 * @copyright 2018 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @author 2018 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\TwoFactorTOTP\Test\Unit\Provider;

use ChristophWurst\Nextcloud\Testing\TestCase;
use OCA\TwoFactorTOTP\Provider\AtLoginProvider;
use OCA\TwoFactorTOTP\Provider\TotpProvider;
use OCA\TwoFactorTOTP\Service\ITotp;
use OCA\TwoFactorTOTP\Settings\Personal;
use OCP\AppFramework\IAppContainer;
use OCP\AppFramework\Services\IInitialState;
use OCP\IL10N;
use OCP\IURLGenerator;
use OCP\IUser;
use PHPUnit\Framework\MockObject\MockObject;

class TotpProviderTest extends TestCase {

	/** @var ITotp|MockObject */
	private $totp;

	/** @var IL10N|MockObject */
	private $l10n;

	/** @var IAppContainer|MockObject */
	private $container;

	/** @var IInitialStateService|MockObject */
	private $initialState;

	/** @var IURLGenerator|MockObject */
	private $urlGenerator;

	/** @var TotpProvider */
	private $provider;

	protected function setUp(): void {
		parent::setUp();

		$this->totp = $this->createMock(ITotp::class);
		$this->l10n = $this->createMock(IL10N::class);
		$this->container = $this->createMock(IAppContainer::class);
		$this->initialState = $this->createMock(IInitialState::class);
		$this->urlGenerator = $this->createMock(IURLGenerator::class);

		$this->provider = new TotpProvider(
			$this->totp,
			$this->l10n,
			$this->container,
			$this->initialState,
			$this->urlGenerator
		);
	}

	public function testGetId(): void {
		$expectedId = 'totp';

		$id = $this->provider->getId();

		self::assertEquals($expectedId, $id);
	}

	public function testGetDisplayName(): void {
		$expected = 'TOTP (Authenticator app)';

		$displayName = $this->provider->getDisplayName();

		self::assertEquals($expected, $displayName);
	}

	public function testGetDescription(): void {
		$description = 'Authenticate with a TOTP app';
		$this->l10n->expects($this->once())
			->method('t')
			->willReturnArgument(0);

		$descr = $this->provider->getDescription();

		self::assertEquals($description, $descr);
	}

	public function testGetLightIcon(): void {
		$this->urlGenerator->expects(self::once())
			->method('imagePath')
			->with('twofactor_totp', 'app.svg')
			->willReturn('/path/to/app.svg');

		$icon = $this->provider->getLightIcon();

		self::assertEquals('/path/to/app.svg', $icon);
	}

	public function testGetDarkIcon(): void {
		$this->urlGenerator->expects(self::once())
			->method('imagePath')
			->with('twofactor_totp', 'app-dark.svg')
			->willReturn('/path/to/app-dark.svg');

		$icon = $this->provider->getDarkIcon();

		self::assertEquals('/path/to/app-dark.svg', $icon);
	}

	public function testGetPersonalSettings(): void {
		$expected = new Personal();

		$user = $this->createMock(IUser::class);
		$this->totp->expects($this->once())
			->method('hasSecret')
			->with($user)
			->willReturn(true);
		$this->initialState->expects($this->once())
			->method('provideInitialState')
			->with(
				'state',
				true
			);

		$actual = $this->provider->getPersonalSettings($user);

		self::assertEquals($expected, $actual);
	}

	public function testDeactivate(): void {
		$user = $this->createMock(IUser::class);
		$this->totp->expects($this->once())
			->method('deleteSecret')
			->with($user);

		$this->provider->disableFor($user);
	}

	public function testGetSetupProvider(): void {
		/** @var IUser|MockObject $user */
		$user = $this->createMock(IUser::class);
		$provider = $this->createMock(AtLoginProvider::class);
		$this->container->expects($this->once())
			->method('query')
			->with(AtLoginProvider::class)
			->willReturn($provider);

		$result = $this->provider->getLoginSetup($user);

		self::assertSame($provider, $result);
	}
}
