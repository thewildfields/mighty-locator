/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element} Element to render.
 */
export default function save() {
	return (
		<>
			<form className='psf mlForm' method='POST'>
				<input type='hidden' name='psf-author-id' />
				<div className='colGr'>
					<div className='colGr__col colGr__col_6'>
						<div className='mlForm__inputGroup'>
							<input className='mlForm__input' name='psf-first-name' type='text' value="Oleksii" required />
							<label className='mlForm__label' for='psf-first-name'>First Name</label>
						</div>
					</div>
					<div className='colGr__col colGr__col_6'>
						<div className='mlForm__inputGroup'>
							<input className='mlForm__input' name='psf-last-name' type='text' value="Tsioma" required />
							<label className='mlForm__label' for='psf-last-name'>Last Name</label>
						</div>
					</div>
					<div className='colGr__col colGr__col_12'>
						<div className='mlForm__inputGroup'>
							<input className='mlForm__input' name='psf-street-address' type='text' />
							<label className='mlForm__label' for='psf-street-address'>Street Address</label>
						</div>
					</div>
					<div className='colGr__col colGr__col_4'>
						<div className='mlForm__inputGroup'>
							<input className='mlForm__input' name='psf-city' type='text' />
							<label className='mlForm__label' for='psf-city'>City</label>
						</div>
					</div>
					<div className='colGr__col colGr__col_4'>
						<div className='mlForm__inputGroup'>
							<select className='mlForm__input' name='psf-state'>
								<option value='' selected disabled>Choose State</option>
								<option value='AL'>Alabama</option>
								<option value='AK'>Alaska</option>
								<option value='AZ'>Arizona</option>
								<option value='AR'>Arkansas</option>
								<option value='AS'>American Samoa</option>
								<option value='CA'>California</option>
								<option value='CO'>Colorado</option>
								<option value='CT'>Connecticut</option>
								<option value='DE'>Delaware</option>
								<option value='DC'>District of Columbia</option>
								<option value='FL'>Florida</option>
								<option value='GA'>Georgia</option>
								<option value='GU'>Guam</option>
								<option value='HI'>Hawaii</option>
								<option value='ID'>Idaho</option>
								<option value='IL'>Illinois</option>
								<option value='IN'>Indiana</option>
								<option value='IA'>Iowa</option>
								<option value='KS'>Kansas</option>
								<option value='KY'>Kentucky</option>
								<option value='LA'>Louisiana</option>
								<option value='ME'>Maine</option>
								<option value='MD'>Maryland</option>
								<option value='MA'>Massachusetts</option>
								<option value='MI'>Michigan</option>
								<option value='MN'>Minnesota</option>
								<option value='MS'>Mississippi</option>
								<option value='MO'>Missouri</option>
								<option value='MT'>Montana</option>
								<option value='NE'>Nebraska</option>
								<option value='NV'>Nevada</option>
								<option value='NH'>New Hampshire</option>
								<option value='NJ'>New Jersey</option>
								<option value='NM'>New Mexico</option>
								<option value='NY'>New York</option>
								<option value='NC'>North Carolina</option>
								<option value='ND'>North Dakota</option>
								<option value='MP'>Northern Mariana Islands</option>
								<option value='OH'>Ohio</option>
								<option value='OK'>Oklahoma</option>
								<option value='OR'>Oregon</option>
								<option value='PA'>Pennsylvania</option>
								<option value='PR'>Puerto Rico</option>
								<option value='RI'>Rhode Island</option>
								<option value='SC'>South Carolina</option>
								<option value='SD'>South Dakota</option>
								<option value='TN'>Tennessee</option>
								<option value='TX'>Texas</option>
								<option value='TT'>Trust Territories</option>
								<option value='UT'>Utah</option>
								<option value='VT'>Vermont</option>
								<option value='VA'>Virginia</option>
								<option value='VI'>Virgin Islands</option>
								<option value='WA'>Washington</option>
								<option value='WV'>West Virginia</option>
								<option value='WI'>Wisconsin</option>
								<option value='WY'>Wyoming</option>
							</select>
							{/* <label className='mlForm__label' for='psf-state'>State</label> */}
						</div>
					</div>
					<div className='colGr__col colGr__col_4'>
						<div className='mlForm__inputGroup'>
							<input className='mlForm__input' name='psf-zip' type='text' />
							<label className='mlForm__label' for='psf-zip'>ZIP</label>
						</div>
					</div>
					<div className='colGr__col colGr__col_6'>
						<div className='mlForm__inputGroup'>
							<input className='mlForm__input' name='psf-phone' type='text' />
							<label className='mlForm__label' for='psf-phone'>Phone</label>
						</div>
					</div>
					<div className='colGr__col colGr__col_6'>
						<div className='mlForm__inputGroup'>
							<input className='mlForm__input' name='psf-email' type='text' />
							<label className='mlForm__label' for='psf-email'>Email</label>
						</div>
					</div>
					<div className='colGr__col colGr__col_12'>
						<div className='mlForm__inputGroup'>
							<input className='mlForm__input' name='psf-relatives' type='text' />
							<label className='mlForm__label' for='psf-relatives'>Relatives</label>
						</div>
					</div>
				</div>
					<button className='psf__submit' type='submit' id='person-serch-form-submit'>Search</button>
			</form>
			<div className='psfWaiter'>
				<div className='psfWaiter__loaderContainer'>
					<div className='psfWaiter__loader'></div>
				</div>
				<div className='psfWaiter__notification'></div>
			</div>
		</>
	);
}
