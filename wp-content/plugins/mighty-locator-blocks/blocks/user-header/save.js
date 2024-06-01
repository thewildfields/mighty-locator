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
		<div { ...useBlockProps.save() }>
			<div className='userHeader'>
				<div className='userHeader__avatar'>
					<img src='https://mighty-locator.ddev.site:9999/wp-content/uploads/2024/05/Oleksii_Tsioma_2023_web.jpg'/>
				</div>
				<div className='userHeader__content'>
					<h1 className='userHeader__title'>Welcome, User</h1>
					<p className='userHeader__text'>Professional membership</p>
				</div>
			</div>
		</div>
	);
}
