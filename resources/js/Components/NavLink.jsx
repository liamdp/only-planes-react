import { Link } from '@inertiajs/react';

export default function NavLink({ active = false, className = '', children, ...props }) {
    return (
        <Link
            {...props}
            className={
                'inline-flex items-center px-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none ' +
                (active
                    ? 'text-gray-300 '
                    : 'text-white hover:text-gray-300 focus:text-gray-300 ') +
                className
            }
        >
            {children}
        </Link>
    );
}
